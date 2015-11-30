<?php

/**
 * This is the model class for table "tb_post".
 *
 * The followings are the available columns in table 'tb_post':
 * @property integer $post_id
 * @property string $post_title
 * @property string $post_titleen
 * @property string $post_summary
 * @property string $post_summaryen
 * @property string $post_content
 * @property string $post_contenten
 * @property string $post_image
 * @property string $post_createdate
 * @property integer $post_memberid
 * @property string $post_sublink
 * @property integer $post_typical
 * @property integer $post_status
 * @property integer $post_order
 * @property string $post_cateidarr
 */
class Post extends CActiveRecord
{
    const ENTRY = "post";

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_title, post_createdate, post_memberid, post_status, post_cateidarr', 'required'),
			array('post_memberid, post_typical, post_status, post_order', 'numerical', 'integerOnly'=>true),
			array('post_title, post_titleen, post_image, post_sublink', 'length', 'max'=>255),
                        array('post_cateidarr','length','max'=>100),
                        array('post_image', 'file', 'types'=>'jpg, gif, png','allowEmpty' => true, 'safe' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('post_id, post_title,post_cateidarr, post_titleen, post_summary, post_summaryen, post_content, post_contenten, post_image, post_createdate, post_memberid, post_sublink, post_typical, post_status, post_order', 'safe', 'on'=>'search'),
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
			'post_id' => Yii::t('lang','ID'),
			'post_title' => Yii::t('lang','Tiêu đề'),
			'post_titleen' => Yii::t('lang','Tiêu đề tiếng anh'),
			'post_summary' => Yii::t('lang','Mô tả'),
			'post_summaryen' => Yii::t('lang','Mô tả tiếng anh'),
			'post_content' => Yii::t('lang','Nội dung'),
			'post_contenten' => Yii::t('lang','Nội dung tiếng anh'),
			'post_image' => Yii::t('lang','Ảnh đại diện'),
			'post_createdate' => Yii::t('lang','Ngày đăng'),
			'post_memberid' => Yii::t('lang','Người đăng'),
			'post_sublink' => Yii::t('lang','link'),
			'post_typical' => Yii::t('lang','Tiêu biểu'),
			'post_status' => Yii::t('lang','Trạng thái'),
			'post_order' => Yii::t('lang','Thứ tự'),
                        'post_cateidarr'=>Yii::t('lang','Danh mục'),
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

		$criteria->compare('post_id',$this->post_id);
		$criteria->compare('post_title',$this->post_title,true);
		$criteria->compare('post_titleen',$this->post_titleen,true);
		$criteria->compare('post_summary',$this->post_summary,true);
		$criteria->compare('post_summaryen',$this->post_summaryen,true);
		$criteria->compare('post_content',$this->post_content,true);
		$criteria->compare('post_contenten',$this->post_contenten,true);
		$criteria->compare('post_image',$this->post_image,true);
		$criteria->compare('post_createdate',$this->post_createdate,true);
		$criteria->compare('post_memberid',$this->post_memberid);
		$criteria->compare('post_sublink',$this->post_sublink);
		$criteria->compare('post_typical',$this->post_typical);
		$criteria->compare('post_status',$this->post_status);
		$criteria->compare('post_order',$this->post_order);
                $criteria->compare('post_cateidarr',$this->post_cateidarr);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function IsPostSubLink($str){
        $post = $this->model()->findAll('post_sublink = "'.$str.'"');
        if(count($post)> 0)
            return true;
        return false;
    }
    
    public function maxPostId(){
        $post = $this->model()->find(array('order'=>'post_id DESC'));
        return $post->post_id;
    }
    

}
