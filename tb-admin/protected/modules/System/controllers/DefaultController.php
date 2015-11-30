<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
            TBApplication::render($this, 'index', array(
            ));
	}
        
        public function actionUpdateSystem() {
            if($_POST['titlepage_id'])
            {
                $model = Systems::model()->findByPk($_POST['titlepage_id']);
                $model->sys_value = $_POST['titlepage_value'];
                $model->save();

                $model = Systems::model()->findByPk($_POST['email_id']);
                $model->sys_value = $_POST['email_value'];
                $model->save();
                
                $model = Systems::model()->findByPk($_POST['day_id']);
                $model->sys_value = $_POST['day_value'];
                $model->save();
                
                $model = Systems::model()->findByPk($_POST['time_id']);
                $model->sys_value = $_POST['time_value'];
                $model->save();
                
                $model = Systems::model()->findByPk($_POST['currency_id']);
                $model->sys_value = $_POST['currency_value'];
                $model->save();
                
                $model = Systems::model()->findByPk($_POST['lang_id']);
                $model->sys_value = $_POST['lang_value'];
                $model->save();
                
                $model = Systems::model()->findByPk($_POST['check_comment_id']);
                $model->sys_value = $_POST['lang_value'];
                $model->save();
            }
           
        }
}