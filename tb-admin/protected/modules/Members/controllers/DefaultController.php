<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','UploadMember','changePassword','updateAccount','updateInformation','delete','UpdateField',
                                    'clockMember'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
            TBApplication::render($this,'view',array(
                    'model'=>$this->loadModel($id),
            ));

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Members();
                $memberProfileModel = new MemberProfile();
		$dataProvider=new CActiveDataProvider('Members');
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Members']))
		{
                        $post_member = $_POST['Members'];
                        $post_member_profile = $_POST['MemberProfile'];
                        $password = $post_member['pr_member_password'];
                        $email = $post_member['pr_member_email'];
                        $model->pr_username = $post_member['pr_username'];
			$model->pr_member_email=$email;
                        $model->pr_member_password=$model->generaSalt($password);
                        //$model->pr_member_password="2123";
                        $model->pr_roles_id=$post_member['pr_roles_id'];
                        $model->pr_member_data_register=  date('Y-m-d');
                        $model->pr_member_active=0;
                        $model->pr_member_status=1;
                        $model->pr_member_rand_key=$model->generaSalt($email);
                        if(Members::model()->evalPasswordStrength($password)===true)
                        {
                            if($model->save())
                            {
                                $memberProfileModel->pr_member_profile_display_name=$post_member_profile['pr_member_profile_display_name'];
                                $memberProfileModel->pr_member_profile_images = "/images/no-user.png";
                                $memberProfileModel->pr_member_id=$model->pr_primary_key;
                                $memberProfileModel->save();
                                $this->redirect($this->createUrl('index'),array('dataProvider'=>$dataProvider));
                            }
                        }

		}
                else{
		$this->render('create',array(
			'model'=>$model,
                        'memberProfileModel'=>$memberProfileModel,
                ));}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $memberProfileModel = MemberProfile::model()->find('pr_member_id='.$id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->pr_primary_key));
		}

		$this->render('update',array(
			'model'=>$model,
                        'memberProfileModel'=>$memberProfileModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * 
	 */
	public function actionDelete()
	{
                $id = $_POST['member_id'];
                $result = array();
                $isMemeberInProject = Members::model()->getMemberInProject($id);
                if(!$isMemeberInProject)
                {
                    if($this->loadModel($id)->delete())
                    {
                        $MemberProfileModel = MemberProfile::model()->find('pr_member_id='.  intval($id));
                        $MemberProfileModel->delete();
                    }
                }
                else
                {
                    $result['error'] = "Thành viên này đã được gán vào dự án, không được phép xóa.";
                    PRApplication::renderPlain($this,array(
				'content'=>CJSON::encode($result),
			));
                }
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Members');
                TBApplication::render($this, 'index', array(
                    'dataProvider'=>$dataProvider,
                ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Members('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Members']))
			$model->attributes=$_GET['Members'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Members the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Members::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Members $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pr-members-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        /**
         * Send mail xác nhận đăng ký làm thành viên.
         */
        function actionAjaxSendMailRegister($member_id)
        {
            $model = Members::model()->findByPk($member_id);
            
            $message            = new YiiMailMessage;      
            $params              = "Xin chào <br> Xin vui lòng nhấn vào link dưới đây để chấp nhận đăng ký:<br>
                                    <a href='#'>".$model->pr_member_rand_key."</a>";
            $message->subject    = 'Kích hoặt đăng ký';
            $message->setBody($params, 'text/html');                
            $message->addTo($model->pr_member_email);
            $message->from = 'thongnv@lionsoftwaresolutions.com';   
            Yii::app()->mail->send($message);    
        }
        /*
         * update images
         */
        public function actionUploadMember($id)
        {
                Yii::import("ext.EAjaxUpload.qqFileUploader");

                $folder='uploads/';// folder for uploaded files
                $allowedExtensions = array("jpg","jpeg","gif","png");//array("jpg","jpeg","gif","exe","mov" and etc...
                $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload($folder);
                $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                
                $model = MemberProfile::model()->findByPk($id);
                $model->pr_member_profile_images = '/uploads/'.$result['filename'];
                $model->save();

                $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
                $fileName=$result['filename'];//GETTING FILE NAME
                
                echo $return;// it's array
        }
        
        public function actionChangePassword($id)
        {
            $model = Members::model()->findByPk($id);
            
            $password_current="";
            $password_new = "";
            $error=array('current'=>'','confirm'=>'','blank'=>'','eval'=>'');
            if(isset($_POST['Member']))
            {
                $response = array();
                $Member_arr = $_POST['Member'];
                $password_current = $model->pr_member_password;
                $is_check = true;
                if($Member_arr['pr_member_current_password']=="" || $Member_arr['pr_member_new_password']=="" || $Member_arr['pr_member_confirm_password']=="")
                {
                    $is_check = false;
                    $error['blank']='Bạn chưa nhập hết các trường bắt buộc.';
                }
                elseif(!Members::model()->evalPasswordStrength($Member_arr['pr_member_new_password']))
                {
                    $is_check = false;
                    $error['eval']="Mật khẩu ít nhất phải có 8 ký tự, và không được nhập các ký tự đặt biêt(&, *, $, [, ], etc, space)";
                }
                elseif($password_current != Members::model()->generaSalt($Member_arr['pr_member_current_password']))
                {
                    $is_check = false;
                    $error['current']='Mật khẩu không đúng';
                }
                elseif($Member_arr['pr_member_new_password']!=$Member_arr['pr_member_confirm_password']) {
                    $is_check = false;
                    $error['confirm']='Xác nhận mật khẩu không đúng';
                }
                
                if($is_check)
                {
                    $model->pr_member_password = Members::model()->generaSalt($Member_arr['pr_member_new_password']);
                    if($model->save())
                        $this->redirect(array('view','id'=>$id));
                }
            }
            $this->render('_form_change_password', array(
                        'model'=>$model,
                        'error'=>$error,
                    ));
        }
        
        public function actionUpdateAccount($id)
        {
            $model = Members::model()->findByPk($id);
            if(isset($_POST['Members']))
            {
                $prMembers = $_POST['Members'];
                $model->pr_member_email = $prMembers['pr_member_email'];
                $model->pr_roles_id = $prMembers['pr_roles_id'];
                if($model->save())
                    $this->redirect(array('view','id'=>$id));
            }
            $this->render('_form_update_account', array('model'=>$model));
        }
        
        public function actionUpdateInformation($id)
        {
            $model = MemberProfile::model()->find('pr_member_id='.intval($id));
            
            if(isset($_POST['MemberProfile']))
            {
                $model->attributes = $_POST['MemberProfile'];
                if($model->save())
                {
                     $this->redirect(array('view','id'=>$id));
                }
            }
            $this->render('_form_update_information', array('model'=>$model));
        }
        
        function actionClockMember()
        {
            if(isset($_POST['member_id']) && isset($_POST['status_id']))
            $model = Members::model()->findByPk($_POST['member_id']);
            $model->pr_member_status = $_POST['status_id'];
            if($model->save())
            {
                if($_POST['status_id']==0)
                    echo '{"status":"clock"}';
                else
                    echo '{"status":"unclock"}';
            }
        }
        
}