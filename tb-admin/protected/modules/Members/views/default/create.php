<?php
/* @var $this DefaultController */
/* @var $model Members */
/* @var $memberProfileModel MemberProfile */

$this->breadcrumbs=array(
	'Pr Members'=>array('index'),
	'Create',
);

//$this->menu=array(
//	array('label'=>'List Members', 'url'=>array('index')),
//	array('label'=>'Manage Members', 'url'=>array('admin')),
//);
//?>

<h1>Thêm thành viên</h1>
<?php $this->renderPartial('_form', array('model'=>$model,'memberProfileModel'=>$memberProfileModel)); ?>