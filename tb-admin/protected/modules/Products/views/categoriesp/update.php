<?php
/* @var $this CategoriespController */
/* @var $model Categoriesp */

$this->breadcrumbs=array(
	'Categoriesp'=>array('index'),
	$model->cate_id=>array('view','id'=>$model->cate_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Categoriesp', 'url'=>array('index')),
	array('label'=>'Create Categoriesp', 'url'=>array('create')),
	array('label'=>'View Categoriesp', 'url'=>array('view', 'id'=>$model->cate_id)),
	array('label'=>'Manage Categoriesp', 'url'=>array('admin')),
);
?>

<h1>Update Categoriesp <?php echo $model->cate_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>