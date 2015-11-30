<?php

class DefaultController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('index','view','commentMember','viewListComment','viewListCommentReply'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','deleteAll','admin','delete'),
				'users'=>array('@'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->comment_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->comment_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionReplyAdmin($entry,$entry_id,$parent_id=0)
        {
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
                        $model->comment_create = date('Y-m-d h:i:s');
                        $model->comment_entry = $entry;
                        $model->comment_entry_id = $entry_id;
                        $model->comment_memberid = YII::app()->user->id;
                        $model->comment_parent = $parent_id;
                        $model->comment_status = 1;
			if($model->save())
				$this->redirect(array('admin','id'=>$model->comment_id));
		}

		$this->render('from_reply_admin',array(
			'model'=>$model,
		));
        }
        
        public function actionCommentMember()
        {
            if(isset($_POST['entry']) && isset($_POST['entry_id']))
            {
                $entry = $_POST['entry'];
                $entry_id = $_POST['entry_id'];
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $parent = 0;$parent_root=0;
                if(isset($_POST['parent']))
                    $parent = $_POST['parent'];
                if(isset($_POST['parent_root']))
                    $parent_root = $_POST['parent_root'];
                if(isset($_POST['comment_name']) && isset($_POST['comment_content']))
		{
			$model->comment_name=$_POST['comment_name'];
                        $model->comment_email=$_POST['comment_email'];
                        $model->comment_content=$_POST['comment_content'];
                        $model->comment_entry = $entry;
                        $model->comment_entry_id = $entry_id;
                        $model->comment_create = date('Y-m-d h:i:s');
                        $model->comment_parent = $parent_root;
                        $model->comment_read = Comment::COMMENT_UN_READ;
                        $model->comment_status = Comment::COMMENT_UN_APPROVED;
                        
			if($model->save())
                        {
                            echo 'success';
                        }
                        else
                        {
                            echo CHtml::errorSummary($model);
                        }
		}
                else{
                    	$this->renderPartial('Comments.views.default.form_comment_member',array(
                            'model'=>$model,
                            'entry'=>$entry,
                            'entry_id'=>$entry_id,
                            'parent'=>$parent,
                            'parent_root'=>$parent_root
                        ));
                }
            }
        }
        
        function actionViewListComment()
        {  
            if(isset($_POST['entry']) && isset($_POST['entry_id']))
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		$model->comment_entry = $_POST['entry'];
                $model->comment_entry_id = $_POST['entry_id'];
                $model->comment_parent = 0;
		$this->renderPartial('Comments.views.default.view_list_comment_entry',array(
			'model'=>$model,
		));
        }
        
        function actionViewListCommentReply($parent_id)
        {  
		$modelReply=new Comment('search');
		$modelReply->unsetAttributes();  // clear any default values
                $modelReply->comment_parent = $parent_id;
		$this->renderPartial('Comments.views.default._view_list_comment_reply_entry',array(
			'modelReply'=>$modelReply,
		));
        }

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionDeleteAll(){
            $arr_id = array();
            $arr_id = $_POST['id'];
            $result = array();
            if(count($arr_id)>0)
            {
                Comment::model()->deleteAll('comment_id IN ('.implode(",",$arr_id) .')');
                $result['status'] = true;
            }
            else
                $result['status'] = false;
            echo json_encode($result);
        }
}
