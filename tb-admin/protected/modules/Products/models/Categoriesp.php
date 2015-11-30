<?php

/**
 * This is the model class for table "tb_categories".
 *
 * The followings are the available columns in table 'tb_categories':
 * @property integer $cate_id
 * @property string $cate_title
 * @property string $cate_content
 * @property string $cate_image
 * @property string $cate_sublink
 * @property string $cate_createdate
 * @property integer $cate_status
 * @property integer $cate_parent
 * @property integer $cate_order
 */
class Categoriesp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_title, cate_sublink, cate_createdate, cate_status, cate_order', 'required'),
			array('cate_status, cate_parent, cate_order', 'numerical', 'integerOnly'=>true),
			array('cate_title, cate_image, cate_sublink', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cate_id, cate_title, cate_content, cate_image, cate_sublink, cate_createdate, cate_status, cate_parent, cate_order', 'safe', 'on'=>'search'),
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
			'cate_id' => 'Cate',
			'cate_title' => Yii::t('lang','Tiêu đề'),
			'cate_content' => Yii::t('lang','Nội dung'),
			'cate_image' => Yii::t('lang','Ảnh minh họa'),
			'cate_sublink' => Yii::t('lang','Link'),
			'cate_createdate' => Yii::t('lang','Ngày tạo'),
			'cate_status' => Yii::t('lang','Trạng thái'),
			'cate_parent' => Yii::t('lang','Mục cha'),
			'cate_order' => Yii::t('lang','Thứ tự'),
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

		$criteria->compare('cate_id',$this->cate_id);
		$criteria->compare('cate_title',$this->cate_title,true);
		$criteria->compare('cate_content',$this->cate_content,true);
		$criteria->compare('cate_image',$this->cate_image,true);
		$criteria->compare('cate_sublink',$this->cate_sublink,true);
		$criteria->compare('cate_createdate',$this->cate_createdate,true);
		$criteria->compare('cate_status',$this->cate_status);
		$criteria->compare('cate_parent',$this->cate_parent);
		$criteria->compare('cate_order',$this->cate_order);
                $criteria->order = 'cate_order ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categoriesp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getArrayCateByParent($parrent=0,$space="",$cate_id=false){
            $arrCate=$this->model()->findAll();
            $arr = array();
            $arr += $this->getArrayParent($arrCate,$parrent,$space="",$cate_id=false);
            return $arr;
        }
        public function getArrayParent($arrCate,$parrent=0,$space="",$cate_id=false){
            $arrCateParent = array();
            $category=array();
            foreach ($arrCate as $item) {
                if($item->cate_parent == $parrent)
                {
                    $category=$this->model()->findAll('cate_parent='.intval($item->cate_id));
                    $arrCateParent[$item->cate_id]=  $space.$item->cate_title;
                    $arrCateParent = $arrCateParent + $this->getArrayParent($category,$item->cate_id,$space.'--',$cate_id);
                }
            }
            return $arrCateParent;
        }
        
    /**
     * Kiểm tra xem sublink có trong hệ thống chưa?
     * Tồn tại return true;
     * @param type $str
     */
    public function IsCateSubLink($str){
        $page = $this->model()->findAll('cate_sublink = "'.$str.'"');
        if(count($page)> 0)
            return true;
        return false;
    }
    
    public function maxCateId(){
        $cate = $this->model()->find(array('order'=>'cate_id DESC'));
        return $cate->cate_id;
    }
    
    public function getCategoryByParentId($parent_id){
        $criteria= new CDbCriteria();
        $criteria->compare('cate_parent', $parent_id);
        $criteria->order = 'cate_order ASC';
        $dateProvider= new CActiveDataProvider($this,array(
            'criteria'=>$criteria,
        ));
        return $dateProvider;
    }
}
