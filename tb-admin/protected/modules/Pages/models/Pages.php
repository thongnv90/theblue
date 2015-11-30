<?php

/**
 * This is the model class for table "tb_pages".
 *
 * The followings are the available columns in table 'tb_pages':
 * @property integer $page_id
 * @property string $page_title
 * @property string $page_content
 * @property string $page_sublink
 * @property string $page_tag
 * @property string $page_createdate
 * @property integer $page_parent
 * @property integer $page_status
 * @property integer $page_order
 * @property string $page_titleen
 * @property string $page_contenten
 */
class Pages extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb_pages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_title, page_sublink, page_createdate, page_parent, page_status, page_content', 'required'),
			array('page_parent, page_status, page_order', 'numerical', 'integerOnly'=>true),
			array('page_title, page_sublink, page_tag, page_titleen', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('page_id, page_title, page_order, page_content, page_sublink, page_tag, page_createdate, page_parent, page_status, page_titleen, page_contenten', 'safe', 'on'=>'search'),
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
			'page_id' => 'ID',
			'page_title' => Yii::t('lang', 'Tiêu đề'),
			'page_content' => Yii::t('lang', 'Nội dung'),
			'page_sublink' => 'Sublink',
			'page_tag' => Yii::t('lang', 'Thẻ'),
			'page_createdate' => Yii::t('lang', 'Ngày tạo'),
			'page_parent' => 'Page Parent',
			'page_status' => Yii::t('lang', 'Trạng thái'),
			'page_titleen' => Yii::t('lang', 'Tiêu đề tiếng anh'),
			'page_contenten' => Yii::t('lang', 'Nội dung tiếng anh'),
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

		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_content',$this->page_content,true);
		$criteria->compare('page_sublink',$this->page_sublink,true);
		$criteria->compare('page_tag',$this->page_tag,true);
		$criteria->compare('page_createdate',$this->page_createdate,true);
		$criteria->compare('page_parent',$this->page_parent);
		$criteria->compare('page_status',$this->page_status);
                $criteria->compare('page_order',$this->page_status);
		$criteria->compare('page_titleen',$this->page_titleen,true);
		$criteria->compare('page_contenten',$this->page_contenten,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Pages the static model class
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
    public function menuSelectPage($parrent = 0,$space="",$selected_id="") 
    {
        $pages=$this->model()->findAll();
        $select='<select id="Pages_page_parent" name="Pages[page_parent]">';
            $select.='<option value="0">Select parrent</option>' ;
            $select.=$this->SelectOptions($pages,$parrent,$space,$selected_id);
        $select.='</select>';
        return $select;
    }
    
    public function SelectOptions($array,$parrent = 0,$space="",$selected_id="") 
    {
        $option="";$selected="";
        foreach ($array as $item) 
        {
            if ($item->page_parent == $parrent) 
            {
                if($selected_id == $item->page_id)
                    $selected = "selected";
                $pages=$this->model()->findAll('page_parent='.intval($item->page_id));
                $option.='<option value="'.$item->page_id.'" '.$selected.'>';
                    $option.=$space.$item->page_title;
                $option.='</option>';
                $option.=$this->SelectOptions($pages, $item->page_id,$space.'--',$selected_id);
            }
            
        }
        return $option;
    }
    
    
    
    /**
     * Menu đệ quy lấy theo ul,li
     * @param type $menus
     * @param type $parrent
     */
    public function showMenu($menus = array(), $parrent = 0) 
    {
        foreach ($menus as $key => $val) 
        {
            echo '<ul>';
            if ($val['parent'] == $parrent) 
            {
                unset($menus[$key]);
                echo '<li><a href="', $val['link'], '">', $val['name'], '</a>';
                show_menu($menus, $val['id'], false);
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    
    /**
     * Kiểm tra xem sublink có trong hệ thống chưa?
     * Tồn tại return true;
     * @param type $str
     */
    public function IsPageSubLink($str){
        $page = $this->model()->findAll('page_sublink = "'.$str.'"');
        if(count($page)> 0)
            return true;
        return false;
    }
    
    public function maxPageId(){
        $page = $this->model()->find(array('order'=>'page_id DESC'));
        if(count($page)<=0)
            return 0;
        return $page->page_id;
    }
    
}
