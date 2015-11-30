<?php

/**
 * This is the model class for table "tb_comment".
 *
 * The followings are the available columns in table 'tb_comment':
 * @property integer $comment_id
 * @property string $comment_content
 * @property integer $comment_parent
 * @property integer $comment_status
 * @property string $comment_create
 * @property integer $comment_memberid
 * @property string $comment_name
 * @property string $comment_email
 * @property string $comment_entry
 * @property integer $comment_entry_id
 * @property integer $comment_read
 */
class Comment extends CActiveRecord
{
    const COMMENT_APPROVED = 2;
    const COMMENT_UN_APPROVED = 1;
    const COMMENT_CANCEL = 0;
    const COMMENT_LABEL_APPROVED = 'Đã duyệt';
    const COMMENT_LABEL_UN_APPROVED = 'Chưa duyệt';
    const COMMENT_LABEL_CANCEL = 'Bị hủy';
    

    const COMMENT_READ = 1;
    const COMMENT_UN_READ=0;
    

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_content, comment_name', 'required'),
			array('comment_parent, comment_status, comment_memberid, comment_entry_id, comment_read', 'numerical', 'integerOnly'=>true),
                        array('comment_email', 'length', 'max'=>255),
                        array('comment_name', 'length', 'max'=>100),
                        array('comment_entry','length', 'max'=>20),
                        array('comment_email','email','message'=>'Email không hợp lệ'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('comment_id, comment_email, comment_name, comment_content, comment_parent, comment_status, comment_create, comment_memberid, comment_entry, comment_entry_id, comment_read', 'safe', 'on'=>'search'),
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
			'comment_id' => 'id',
			'comment_content' => Yii::t('lang', 'Nội dung'),
			'comment_parent' => Yii::t('lang', ''),
			'comment_status' => Yii::t('lang', 'Trạng thái'),
			'comment_create' => Yii::t('lang', 'Ngày tạo'),
			'comment_memberid' => Yii::t('lang', 'Tên'),
                        'comment_name' => Yii::t('lang', 'Tên'),
                        'comment_email' => Yii::t('lang', 'Thư điện tử'),
                        'comment_entry' => YII::t('lang', 'Entry'),
                        'comment_entry_id' => YII::t('lang', 'Entry ID'),
                        'comment_read'=>YII::t('lang','Đọc')
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

		$criteria->compare('comment_id',$this->comment_id);
		$criteria->compare('comment_content',$this->comment_content,true);
                $criteria->compare('comment_email',$this->comment_content,true);
                $criteria->compare('comment_name',$this->comment_content,true);
		$criteria->compare('comment_parent',$this->comment_parent);
		$criteria->compare('comment_status',$this->comment_status);
		$criteria->compare('comment_create',$this->comment_create,true);
		$criteria->compare('comment_memberid',$this->comment_memberid);
                $criteria->compare('comment_read',$this->comment_read);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getStatusComment(){
            return array(
                self::COMMENT_UN_APPROVED => self::COMMENT_LABEL_APPROVED,
                self::COMMENT_APPROVED => self::COMMENT_LABEL_APPROVED,
                self::COMMENT_CANCEL => self::COMMENT_LABEL_CANCEL,
            );
        }
}
