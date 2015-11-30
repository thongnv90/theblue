<?php

/**
 * This is the model class for table "tb_categorypost".
 *
 * The followings are the available columns in table 'tb_categorypost':
 * @property integer $cate_id
 * @property string $cate_title
 * @property string $cate_summany
 * @property string $cate_sublink
 * @property integer $cate_parent
 * @property integer $cate_order
 * @property integer $cate_status
 */
class Categories extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_categorypost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cate_title, cate_status', 'required'),
			array('cate_order, cate_status, cate_parent', 'numerical', 'integerOnly'=>true),
			array('cate_title, cate_sublink', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cate_id, cate_title, cate_summany, cate_sublink, cate_order, cate_status, cate_parent', 'safe', 'on'=>'search'),
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
			'cate_id' => 'ID',
			'cate_title' => 'Tiều đề',
			'cate_summany' => 'Ghi chú',
			'cate_sublink' => 'link không dấu',
			'cate_order' => 'Thứ tự',
			'cate_status' => 'Trạng thái',
                        'cate_parent'=>'Danh mục cha',
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
		$criteria->compare('cate_summany',$this->cate_summany,true);
		$criteria->compare('cate_sublink',$this->cate_sublink,true);
		$criteria->compare('cate_order',$this->cate_order);
		$criteria->compare('cate_status',$this->cate_status);
                $criteria->compare('cate_parent',$this->cate_parent);
                $criteria->order = 'cate_order ASC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categories the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
    /**
     * MENU đệ quy lấy theo select
     * @param type $menus
     * @param type $parrent
     */
    public function menuSelectCategory($parrent = 0,$space="",$selected_id="",$cate_id=false) 
    {
        $category=$this->model()->findAll();
        $select='<select id="Categories_cate_parent" name="Categories[cate_parent]">';
            $select.='<option value="0">Select parrent</option>' ;
            $select.=$this->SelectOptions($category,$parrent,$space,$selected_id,$cate_id);
        $select.='</select>';
        return $select;
    }
    
    public function SelectOptions($array,$parrent = 0,$space="",$selected_id="",$cate_id=false) 
    {
        $option="";$selected="";
        foreach ($array as $item) 
        {
            if ($item->cate_parent == $parrent && $item->cate_id != $cate_id) 
            {
                if($selected_id == $item->cate_id)
                    $selected = "selected";
                $category=$this->model()->findAll('cate_parent='.intval($item->cate_id));
                $option.='<option value="'.$item->cate_id.'" '.$selected.'>';
                    $option.=$space.$item->cate_title;
                $option.='</option>';
                $option.=$this->SelectOptions($category, $item->cate_id,$space.'--',$selected_id,$cate_id);
            }
            
        }
        return $option;
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
    
        /*
     * Lấy danh mục theo định dạng mảng
     * @return array
     * @access public
     */
    public function getCategoryArray($cate_arr_id=false)
    {
        $criteria = "";
        if($cate_arr_id)
        {
            $criteria = new CDbCriteria;
            $criteria->condition = 'cate_id IN ('.$cate_arr_id.')';
        }

        $model = Categories::model()->findAll($criteria);
        $cateArray = array();
        foreach ($model as $data) {
                $cateArray[$data->cate_id] = $data->cate_title;
        }

        return $cateArray;

    }
}
