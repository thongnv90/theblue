<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->document_id=>array('view','id'=>$model->document_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Document', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'View Document', 'url'=>array('view', 'id'=>$model->document_id)),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<h1>Update Document <?php echo $model->document_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>