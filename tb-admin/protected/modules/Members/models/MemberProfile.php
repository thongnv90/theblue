<?php

/**
 * This is the model class for table "pr_member_profile".
 *
 * The followings are the available columns in table 'pr_member_profile':
 * @property integer $pr_primary_key
 * @property integer $pr_member_id
 * @property string $pr_member_profile_surname
 * @property string $pr_member_profile_given_name
 * @property string $pr_member_profile_display_name
 * @property string $pr_member_profile_phone
 * @property string $pr_member_profile_address
 * @property string $pr_member_profile_images
 * @property string $pr_member_profile_date
 */
class MemberProfile extends CActiveRecord
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pr_member_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pr_member_profile_display_name', 'required'),
			array('pr_member_id', 'numerical', 'integerOnly'=>true),
			array('pr_member_profile_surname, pr_member_profile_given_name, pr_member_profile_display_name', 'length', 'max'=>100),
			array('pr_member_profile_phone', 'length', 'max'=>20),
			array('pr_member_profile_address, pr_member_profile_images', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pr_primary_key, pr_member_id, pr_member_profile_surname, pr_member_profile_given_name, pr_member_profile_display_name, pr_member_profile_phone, pr_member_profile_address, pr_member_profile_images, pr_member_profile_date', 'safe', 'on'=>'search'),
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
			'pr_primary_key' => 'Pr Primary Key',
			'pr_member_id' => 'Pr Member',
			'pr_member_profile_surname' => 'Họ',
			'pr_member_profile_given_name' => 'Tên',
			'pr_member_profile_display_name' => 'Họ tên',
			'pr_member_profile_phone' => 'Số điện thoại',
			'pr_member_profile_address' => 'Địa chỉ',
			'pr_member_profile_images' => 'Ảnh đại diện',
			'pr_member_profile_date' => 'Ngày tạo tài khoản',
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

		$criteria->compare('pr_primary_key',$this->pr_primary_key);
		$criteria->compare('pr_member_id',$this->pr_member_id);
		$criteria->compare('pr_member_profile_surname',$this->pr_member_profile_surname,true);
		$criteria->compare('pr_member_profile_given_name',$this->pr_member_profile_given_name,true);
		$criteria->compare('pr_member_profile_display_name',$this->pr_member_profile_display_name,true);
		$criteria->compare('pr_member_profile_phone',$this->pr_member_profile_phone,true);
		$criteria->compare('pr_member_profile_address',$this->pr_member_profile_address,true);
		$criteria->compare('pr_member_profile_images',$this->pr_member_profile_images,true);
		$criteria->compare('pr_member_profile_date',$this->pr_member_profile_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MemberProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * Chức năng: Lấy thông tin của nhiều thành viên 
         * @param type $member_id_arr
         * @return \CActiveDataProvider
         */
        public function getMemberProfile($member_id_arr,$pages=0,$activePages=false)
        {
            $pagination = false;
            if($activePages)
            {
                $pagination=array();
            }
            $offset = $pages*8;
            $criteria = new CDbCriteria();
            $criteria->condition = "pr_member_id IN (".$member_id_arr.")";
            $criteria->limit=8;
            $criteria->offset=$offset;
            
            $dataProvider = new CActiveDataProvider($this,array(
                                        'criteria'=>$criteria,
                                        'pagination' => $pagination,
            ));
            
            return $dataProvider;
       }
       
       /**
        * Chức năng: Lấy tên hiện thị của thành viên
        * @param type $memeber_id
        * @return string
        */
       public function getFullname($member_id)
       {
           $memberProfile = MemberProfile::model()->find('pr_member_id='.intval($member_id));
           if($memberProfile->pr_member_id==Yii::app()->user->id)
           {
               return 'Tôi';
           }
           else
               return $memberProfile->pr_member_profile_display_name;
       }
       
       public function getProfileUrl($member_id=0){
           if($member_id==0) $member_id=$this->pr_member_id;
           $memberProfile = MemberProfile::model()->find('pr_member_id='.intval($member_id));
           
           $images_url = Yii::app()->getBaseUrl().$memberProfile->pr_member_profile_images;
           if(file_exists(Yii::getPathOfAlias('webroot').'/uploads/test.html'))
               return $images_url;
           return Yii::app()->getBaseUrl().'/images/no-user.png';
       }
}
