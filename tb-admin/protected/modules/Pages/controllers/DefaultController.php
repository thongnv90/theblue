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
				'actions'=>array('index','view','create','update','deleteAll','delete','admin','updateStatus'),
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
		$model=new Pages;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
                        $sublink = TBApplication::removesign($_POST['Pages']['page_title']);
                        if(Pages::model()->IsPageSubLink($sublink)){
                            $id = Pages::model()->maxPageId()+1;
                            $model->page_sublink =  TBApplication::removesign($_POST['Pages']['page_title']).$id;
                        }
                        else{
                            $model->page_sublink =  TBApplication::removesign($_POST['Pages']['page_title']);
                        }

                        $model->page_createdate =  date('Y-m-d H:i:s');
			if($model->save())
				$this->redirect(array('view','id'=>$model->page_id));
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

		if(isset($_POST['Pages']))
		{
			$model->attributes=$_POST['Pages'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->page_id));
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
        
	public function actionDeleteAll()
	{
            $arr_id = array();
            $arr_id = $_POST['id'];
            $result = array();
            if(count($arr_id)>0)
            {
                Pages::model()->deleteAll('page_id IN ('.implode(",",$arr_id) .')');
                $result['status'] = true;
            }
            else
                $result['status'] = false;
            echo json_encode($result);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pages');
		TBApplication::render($this,'index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pages('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pages']))
			$model->attributes=$_GET['Pages'];

                    TBApplication::render($this,'admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pages the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pages::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pages $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pages-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionUpdateStatus(){
            if(isset($_POST['page_id']) && isset($_POST['status']))
            {
                $model = Pages::model()->findByPk($_POST['page_id']);
                $model->page_status = $_POST['status'];
                if($model->save())
                    echo "{'status':'success'}";
                else
                    echo "{'status':'fail'}";
            }
        }
}