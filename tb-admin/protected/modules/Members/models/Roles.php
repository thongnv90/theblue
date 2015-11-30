<?php

/**
 * This is the model class for table "pr_roles".
 *
 * The followings are the available columns in table 'pr_roles':
 * @property integer $pr_primary_key
 * @property string $pr_roles_name
 * @property string $pr_roles_description
 * @property integer $pr_roles_status
 */
class Roles extends CActiveRecord
{
    const PR_QUERY_RETURN_TYPE_DROPDOWN_ARRAY = 'DropdownArray';
    const PR_QUERY_RETURN_TYPE_AVTIVE_DATA_PROVIDER = 'DataProvider';

    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pr_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('pr_primary_key', 'required'),
			array('pr_roles_status', 'numerical', 'integerOnly'=>true),
			array('pr_roles_name', 'length', 'max'=>100),
			array('pr_roles_description', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pr_primary_key, pr_roles_name, pr_roles_description, pr_roles_status', 'safe', 'on'=>'search'),
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
			'pr_roles_name' => 'Pr Roles Name',
			'pr_roles_description' => 'Pr Roles Description',
			'pr_roles_status' => 'Pr Roles Status',
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
		$criteria->compare('pr_roles_name',$this->pr_roles_name,true);
		$criteria->compare('pr_roles_description',$this->pr_roles_description,true);
		$criteria->compare('pr_roles_status',$this->pr_roles_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrRoles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function GetRoles($return_type=self::PR_QUERY_RETURN_TYPE_AVTIVE_DATA_PROVIDER)
        {
            $criteria = new CDbCriteria();
            $criteria->compare('pr_roles_status','1');
            $criteria->compare('pr_primary_key','3',false,'<>');
            
            $dataProvider = new CActiveDataProvider($this,array('criteria'=>$criteria));
            if($return_type=='DataProvider')
            {
                return $dataProvider;
            }
            else
            {
                $dataArray = array();
                foreach ($dataProvider->data as $data) {
                    $dataArray[$data->pr_primary_key] = $data->pr_roles_name;
                }
                return $dataArray;
            }
            
        }
}
