<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->document_id,
);

$this->menu=array(
	array('label'=>'List Document', 'url'=>array('index')),
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'Update Document', 'url'=>array('update', 'id'=>$model->document_id)),
	array('label'=>'Delete Document', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->document_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<h1>View Document #<?php echo $model->document_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'document_id',
		'document_entity',
		'document_title',
		'document_sublink',
		'document_type',
		'document_name',
		'document_url',
		'document_icon',
		'document_createdate',
		'document_order',
		'document_createby',
		'document_status',
	),
)); ?>
