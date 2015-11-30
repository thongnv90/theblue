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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','admin','delete','UpdatePostTypical',
                                    'updatePostStatus','DeleteAll'),
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
		$model=new Post;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
                        $model->post_content = $_POST['Post']['post_content'];
                        $model->post_contenten = $_POST['Post']['post_contenten'];
                        $model->post_summary = $_POST['Post']['post_summary'];
                        $model->post_summaryen = $_POST['Post']['post_summaryen'];
                        $model->post_order = 0;
                        $model->post_createdate = date('Y-m-d h:i:s');
                        $model->post_memberid = Yii::app()->user->id;
                        $model->post_cateidarr = implode(',',$_POST['Post']['post_cateidarr']);
                        $sublink = TBApplication::removesign($_POST['Post']['post_title']);
                        if(Post::model()->IsPostSubLink($sublink)){
                            $id = Post::model()->maxPostId()+1;
                            $model->post_sublink =  TBApplication::removesign($_POST['Post']['post_title']).$id;
                        }
                        else{
                            $model->post_sublink =  TBApplication::removesign($_POST['Post']['post_title']);
                        }
                        $file=CUploadedFile::getInstance($model,'post_image');
                        $model->post_image = str_replace('.', date("his").'.', $file);
			if($model->save())
                        {
                            $file->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$model->post_image);
                            $this->redirect(array('view','id'=>$model->post_id));
                        }
		}

		TBApplication::render($this,'create',array(
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

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
                        $model->post_content = $_POST['Post']['post_content'];
                        $model->post_contenten = $_POST['Post']['post_contenten'];
                        $model->post_summary = $_POST['Post']['post_summary'];
                        $model->post_summaryen = $_POST['Post']['post_summaryen'];
                        $model->post_cateidarr = implode(',',$_POST['Post']['post_cateidarr']);
                        $file=CUploadedFile::getInstance($model,'post_image');
                        if($file!="")
                        {
                            if($model->post_image!="")
                                unlink(Yii::getPathOfAlias('webroot').'/uploads/'.$model->post_image);
                            $model->post_image = str_replace('.', date("his").'.', $file);
                            
                        }
                            
			if($model->save())
                        {
                            if($file!="")
                                $file->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$model->post_image);
                            $this->redirect(array('view','id'=>$model->post_id));
                        }
		}

		TBApplication::render($this,'update',array(
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
		$dataProvider=new CActiveDataProvider('Post');
		TBApplication::render($this,'index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];

                    TBApplication::render($this,'admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Post the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Post $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionUpdatePostTypical(){
            if(isset($_POST['post_id']))
            {
                $model = Post::model()->findByPk($_POST['post_id']);
                $model->post_typical = $_POST['typical'];
                if($model->save())
                    echo '{"status":"success"}';
                echo '{"status":"fail"}';
            }
        }
        
        public function actionUpdatePostStatus(){
            if(isset($_POST['post_id']))
            {
                $model = Post::model()->findByPk($_POST['post_id']);
                $model->post_status = $_POST['status'];
                if($model->save())
                    echo '{"status":"success"}';
                echo '{"status":"fail"}';
            }
        }
        
        public function actionDeleteAll(){
            $arr_id = array();
            $arr_id = $_POST['id'];
            $result = array();
            if(count($arr_id)>0)
            {
                Post::model()->deleteAll('post_id IN ('.implode(",",$arr_id) .')');
                $result['status'] = true;
            }
            else
                $result['status'] = false;
            echo json_encode($result);
        }
}
