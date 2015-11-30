<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->pro_id,
);

$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Create Products', 'url'=>array('create')),
	array('label'=>'Update Products', 'url'=>array('update', 'id'=>$model->pro_id)),
	array('label'=>'Delete Products', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pro_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>

<h1>View Products #<?php echo $model->pro_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pro_id',
		'pro_cateidarr',
		'pro_title',
		'pro_titleen',
		'pro_images',
		'pro_summary',
		'pro_summaryen',
		'pro_content',
		'pro_contenten',
		'pro_specifications',
		'pro_price',
		'pro_discountprice',
		'pro_typical',
		'pro_sublink',
		'pro_status',
		'pro_order',
		'pro_createdate',
	),
)); ?>
