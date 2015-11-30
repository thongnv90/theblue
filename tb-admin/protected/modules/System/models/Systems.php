<?php

/**
 * This is the model class for table "tb_systems".
 *
 * The followings are the available columns in table 'tb_systems':
 * @property integer $sys_id
 * @property string $sys_name
 * @property string $sys_summary
 * @property string $sys_value
 * @property string $sys_parame
 */
class Systems extends CActiveRecord
{
    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_systems';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('sys_value', 'required'),
			array('sys_name', 'length', 'max'=>100),
			array('sys_summary, sys_value', 'length', 'max'=>255),
			array('sys_parame', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sys_id, sys_name, sys_summary, sys_value, sys_parame', 'safe', 'on'=>'search'),
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
			'sys_id' => 'Sys',
			'sys_name' => 'Name',
			'sys_summary' => 'Summary',
			'sys_value' => 'Value',
			'sys_parame' => 'Parame',
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

		$criteria->compare('sys_id',$this->sys_id);
		$criteria->compare('sys_name',$this->sys_name,true);
		$criteria->compare('sys_summary',$this->sys_summary,true);
		$criteria->compare('sys_value',$this->sys_value,true);
		$criteria->compare('sys_parame',$this->sys_parame,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Systems the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getConfigSys($param){
            $model= Systems::model()->find('sys_parame="'.$param.'"');
            
            return $model;
        }

        
        public function ArrLanguage(){  
            $arrLanguage = array(
                'vi'=>YII::t('lang','Tiếng việt'),
                'en'=>YII::t('lang','Tiếng Anh'),
            ); 
            
            return $arrLanguage;
        }
}
