<?php

/**
 * This is the model class for table "tb_document".
 *
 * The followings are the available columns in table 'tb_document':
 * @property integer $document_id
 * @property string $document_entity
 * @property string $document_title
 * @property string $document_sublink
 * @property string $document_type
 * @property string $document_name
 * @property string $document_url
 * @property string $document_icon
 * @property string $document_createdate
 * @property integer $document_order
 * @property integer $document_createby
 * @property integer $document_status
 * @property integer $document_entityid
 */
class Document extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_document';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_order, document_createby, document_status', 'numerical', 'integerOnly'=>true),
			array('document_entity, document_icon', 'length', 'max'=>100),
			array('document_title, document_sublink, document_name, document_url', 'length', 'max'=>255),
			array('document_type', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('document_id, document_entity, document_title,document_entityid, document_sublink, document_type, document_name, document_url, document_icon, document_createdate, document_order, document_createby, document_status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'document_id' => 'Document',
			'document_entity' => 'Document Entity',
			'document_title' => 'Document Title',
			'document_sublink' => 'Document Sublink',
			'document_type' => 'Document Type',
			'document_name' => 'Document Name',
			'document_url' => 'Document Url',
			'document_icon' => 'Document Icon',
			'document_createdate' => 'Document Createdate',
			'document_order' => 'Document Order',
			'document_createby' => 'Document Createby',
			'document_status' => 'Document Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('document_id',$this->document_id);
		$criteria->compare('document_entity',$this->document_entity,true);
		$criteria->compare('document_title',$this->document_title,true);
		$criteria->compare('document_sublink',$this->document_sublink,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('document_url',$this->document_url,true);
		$criteria->compare('document_icon',$this->document_icon,true);
		$criteria->compare('document_createdate',$this->document_createdate,true);
		$criteria->compare('document_order',$this->document_order);
		$criteria->compare('document_createby',$this->document_createby);
		$criteria->compare('document_status',$this->document_status);
                $criteria->compare('document_entityid', $this->document_entityid,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Document the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function addDocument($entity,$entity_id,$title,$file_name,$file_type)
        {
            $document = new Document();
            $document->document_entity = $entity;
            $document->document_entityid = $entity_id;
            $document->document_title = $title;
            $document->document_sublink=  TBApplication::removesign($title);
            $document->document_name = $file_name.'.'.$file_type;
            $document->document_type = $file_type;
            $document->document_icon = "/images/fileicons/32px/".$file_type.".png";
            $document->document_url = '/uploads/'.$file_name.date('his').'.'.$file_type;
            $document->document_status=1;
            $document->document_order = 0;
            $document->document_createby = Yii::app()->user->id;
            $document->document_createdate = date('Y-m-d h:i:s');
            
            if($document->save())
                return $document->document_id;
            return false;
        }
        
        public function getDocumentByEntity($entity,$entity_id){
            $criteria = new CDbCriteria;
            $criteria->compare('document_entity',$entity);
            $criteria->compare('document_entityid', $entity_id);
            
            $dataProvider = new CActiveDataProvider($this, array(
                                    'criteria'=>$criteria,
            ));
            
            return $dataProvider;
        }
}
