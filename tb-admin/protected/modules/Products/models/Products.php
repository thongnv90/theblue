<?php

/**
 * This is the model class for table "tb_products".
 *
 * The followings are the available columns in table 'tb_products':
 * @property integer $pro_id
 * @property string $pro_cateidarr
 * @property string $pro_title
 * @property string $pro_titleen
 * @property string $pro_images
 * @property string $pro_summary
 * @property string $pro_summaryen
 * @property string $pro_content
 * @property string $pro_contenten
 * @property string $pro_specifications
 * @property string $pro_specificationsen
 * @property string $pro_price
 * @property string $pro_discountprice
 * @property integer $pro_typical
 * @property string $pro_sublink
 * @property integer $pro_status
 * @property integer $pro_order
 * @property string $pro_createdate
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pro_title, pro_images, pro_sublink, pro_order, pro_createdate', 'required'),
			array('pro_typical, pro_status, pro_order', 'numerical', 'integerOnly'=>true),
			array('pro_cateidarr', 'length', 'max'=>100),
			array('pro_title, pro_titleen, pro_images, pro_sublink', 'length', 'max'=>255),
			array('pro_price, pro_discountprice', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pro_id, pro_cateidarr, pro_title, pro_titleen, pro_images, pro_summary, pro_summaryen, pro_content, pro_contenten, pro_specifications, pro_specifications, pro_price, pro_discountprice, pro_typical, pro_sublink, pro_status, pro_order, pro_createdate', 'safe', 'on'=>'search'),
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
			'pro_id' => 'Pro',
			'pro_cateidarr' => Yii::t('lang', 'Danh mục'),
			'pro_title' => Yii::t('lang', 'Tiêu đề'),
			'pro_titleen' => Yii::t('lang','Tiều đề tiếng anh'),
			'pro_images' => Yii::t('lang','Ảnh minh họa'),
			'pro_summary' => Yii::t('lang','Mô tả'),
			'pro_summaryen' => Yii::t('lang','Mô tả tiếng anh'),
			'pro_content' => Yii::t('lang','Nội dung'),
			'pro_contenten' => Yii::t('lang','Nội dung tiếng anh'),
			'pro_specifications' => Yii::t('lang','Thông số kỹ thuật'),
                        'pro_specificationsen' => Yii::t('lang','Thông số kỹ thuật tiếng anh'),
			'pro_price' => Yii::t('lang','Giá'),
			'pro_discountprice' => Yii::t('lang','Giảm giá'),
			'pro_typical' => Yii::t('lang','Tiêu biểu'),
			'pro_sublink' => Yii::t('lang','Link'),
			'pro_status' => Yii::t('lang','Trạng thái'),
			'pro_order' => Yii::t('lang','Thứ tự'),
			'pro_createdate' => Yii::t('lang','Ngày tạo'),
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

		$criteria->compare('pro_id',$this->pro_id);
		$criteria->compare('pro_cateidarr',$this->pro_cateidarr,true);
		$criteria->compare('pro_title',$this->pro_title,true);
		$criteria->compare('pro_titleen',$this->pro_titleen,true);
		$criteria->compare('pro_images',$this->pro_images,true);
		$criteria->compare('pro_summary',$this->pro_summary,true);
		$criteria->compare('pro_summaryen',$this->pro_summaryen,true);
		$criteria->compare('pro_content',$this->pro_content,true);
		$criteria->compare('pro_contenten',$this->pro_contenten,true);
		$criteria->compare('pro_specifications',$this->pro_specifications,true);
		$criteria->compare('pro_price',$this->pro_price,true);
		$criteria->compare('pro_discountprice',$this->pro_discountprice,true);
		$criteria->compare('pro_typical',$this->pro_typical);
		$criteria->compare('pro_sublink',$this->pro_sublink,true);
		$criteria->compare('pro_status',$this->pro_status);
		$criteria->compare('pro_order',$this->pro_order);
		$criteria->compare('pro_createdate',$this->pro_createdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function IsProSubLink($str){
            $pro = $this->model()->findAll('pro_sublink = "'.$str.'"');
            if(count($pro)> 0)
                return true;
            return false;
        }

        public function maxProId(){
            $pro = $this->model()->find(array('order'=>'pro_id DESC'));
            if(count($pro)<=0)
                return 0;
            return $pro->pro_id;
        }
}
