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
				'actions'=>array('create','update','admin','delete','index','view','updateTypicalPro',
                                                'updateStatusPro'),
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
		$model=new Products;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Products']))
		{
			$model->attributes=$_POST['Products'];
                        $model->pro_summary = $_POST['Products']['pro_summary'];
                        $model->pro_content = $_POST['Products']['pro_content'];
                        $model->pro_summaryen = $_POST['Products']['pro_summaryen'];
                        $model->pro_contenten = $_POST['Products']['pro_contenten'];
                        $model->pro_specifications = $_POST['Products']['pro_specifications'];
                        $model->pro_specificationsen = $_POST['Products']['pro_specificationsen'];
                        $model->pro_createdate = date('Y-m-d h:i:s');
                        $model->pro_order = Products::model()->maxProId()+1;
                        $sublink = TBApplication::removesign($_POST['Products']['pro_title']);
                        if(Products::model()->IsProSubLink($sublink)){
                            $id = Products::model()->maxProId()+1;
                            $model->pro_sublink =  TBApplication::removesign($_POST['Products']['pro_title']).$id;
                        }
                        else{
                            $model->pro_sublink =  TBApplication::removesign($_POST['Products']['pro_title']);
                        }
                        $file=CUploadedFile::getInstance($model,'pro_images');
                        $model->pro_images = str_replace('.', date("his").'.', $file);
			if($model->save())
                        {
                            if($file!="")
                                $file->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$model->pro_images);
                            
                            //Add nhiều iamges
                            $attachs = CUploadedFile::getInstancesByName('files');
                            $i=1;
                            foreach ($attachs as $key => $attachItem) {
                                // Tach lay ten va duoi file
                                 $temp = explode('.', $attachItem->name);
                                 
                                 if($attachItem->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$temp[0].date('his').'.'.$temp[1]))
                                 {
                                    $document = new Document();
                                    $document->document_entityid=$model->pro_id;
                                    $document->document_entity = 'product';
                                    $document->document_url='/uploads/'.$temp[0].date('his').'.'.$temp[1];
                                    $document->document_name = $attachItem;
                                    $document->document_icon = "/images/fileicons/32px/".$temp[1].".png";
                                    $document->document_type = $temp[1];
                                    $document->document_createdate = date('Y-m-d h:i:s');
                                    $document->document_order = $i;
                                    $document ->save();
                                 }
                                 $i++;
                            }
                            //END 
                            
                            $this->redirect(array('admin'));
                        }
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

		if(isset($_POST['Products']))
		{
		$model->attributes=$_POST['Products'];
                        $model->pro_summary = $_POST['Products']['pro_summary'];
                        $model->pro_content = $_POST['Products']['pro_content'];
                        $model->pro_summaryen = $_POST['Products']['pro_summaryen'];
                        $model->pro_contenten = $_POST['Products']['pro_contenten'];
                        $model->pro_specifications = $_POST['Products']['pro_specifications'];
                        $model->pro_specificationsen = $_POST['Products']['pro_specificationsen'];
                        $model->pro_order = Products::model()->maxProId()+1;
                        $file=CUploadedFile::getInstance($model,'post_image');
                        if($file!="")
                        {
                            if($model->pro_images!="")
                                unlink(Yii::getPathOfAlias('webroot').'/uploads/'.$model->pro_images);
                            $model->pro_images = str_replace('.', date("his").'.', $file);
                            
                        }
			if($model->save())
                        {
                            if($file!="")
                                $file->saveAs(Yii::getPathOfAlias('webroot').'/uploads/'.$model->pro_images);
                            $this->redirect(array('admin'));
                        }
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
		$dataProvider=new CActiveDataProvider('Products');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Products('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Products']))
			$model->attributes=$_GET['Products'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Products the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Products::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Products $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='products-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionUpdateTypicalPro(){
            if($_POST['pro_id'])
            {
                $model= Products::model()->findByPk($_POST['pro_id']);
                $model->pro_typical = $_POST['typical'];
                if($model->save())
                    echo '{"status":"success"}';
                else
                    echo'{"status":"fail"}';
            }
        }
        
        public function actionUpdateStatusPro(){
            if($_POST['pro_id'])
            {
                $model= Products::model()->findByPk($_POST['pro_id']);
                $model->pro_status = $_POST['status'];
                if($model->save())
                    echo '{"status":"success"}';
                else 
                    echo'{"status":"fail"}';
            }
        }


}
