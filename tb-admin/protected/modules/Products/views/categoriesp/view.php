<?php
/* @var $this CategoriespController */
/* @var $model Categoriesp */

$this->breadcrumbs=array(
	'Categoriesp'=>array('index'),
	$model->cate_id,
);

$this->menu=array(
	array('label'=>'List Categoriesp', 'url'=>array('index')),
	array('label'=>'Create Categoriesp', 'url'=>array('create')),
	array('label'=>'Update Categoriesp', 'url'=>array('update', 'id'=>$model->cate_id)),
	array('label'=>'Delete Categoriesp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cate_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Categoriesp', 'url'=>array('admin')),
);
?>

<h1>View Categoriesp #<?php echo $model->cate_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cate_id',
		'cate_title',
		'cate_content',
		'cate_image',
		'cate_sublink',
		'cate_createdate',
		'cate_status',
		'cate_parent',
		'cate_order',
	),
)); ?>
