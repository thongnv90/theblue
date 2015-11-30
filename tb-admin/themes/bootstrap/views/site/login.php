<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title>Đăng nhập</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form_login/demo.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form_login/style.css" />
</head>

<?php

/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<body>
    <div class="container">
        <div class="codrops-top">&nbsp;</div>
        <header>
            <h1>&nbsp;</h1>
        </header>
        <section>				
            <div id="container_demo" >
                <div id="wrapper">
                    <div id="login" class="animate form">
                        <div class="form">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'login-form',
                                'enableClientValidation'=>true,
                                'clientOptions'=>array(
                                        'validateOnSubmit'=>true,
                                ),
                        )); ?>

                                <h1>ĐĂNG NHẬP</h1> 
    <!--                            <p class="note">Fields with <span class="required">*</span> are required.</p>-->
                                <p> 
                        <!--            <label for="username" class="uname" data-icon="u" > Your email or username </label>-->
                        <!--            <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>-->
                                        <?php echo $form->labelEx($model,'username',array('data-icon'=>'u')); ?>
                                        <?php echo $form->textField($model,'username',array('required'=>'required','placeholder'=>'myemail&gmail.com')); ?>
                                        <?php //echo $form->error($model,'username'); ?>
                                </p>
                                <p> 
                        <!--            <label for="password" class="youpasswd" data-icon="p"> Your password </label>-->
                        <!--            <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> -->
                                        <?php echo $form->labelEx($model,'password',array('data-icon'=>'p')); ?>
                                        <?php echo $form->passwordField($model,'password',array('required'=>'required','placeholder'=>'********')); ?>
                                        <?php echo $form->error($model,'password'); ?>
                                </p>
                                <p class="keeplogin"> 
                        <!--                                                <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                                                        <label for="loginkeeping">Keep me logged in</label>-->
                                    <?php echo $form->checkBox($model,'rememberMe'); ?>
                                    <?php echo $form->label($model,'rememberMe'); ?>
                                    <?php echo $form->error($model,'rememberMe'); ?>
                                                                </p>
                                <p class="login button"> 
                        <!--            <input type="submit" value="Login" /> -->
                                        <?php echo CHtml::submitButton('Đăng nhập'); ?>
                                                                </p>
                                <p class="change_link"></p>

                        <?php $this->endWidget(); ?>
                        </div><!-- form -->
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>