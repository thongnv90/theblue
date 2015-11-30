<?php
/* @var $this CategoriespController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categoriesp',
);

$this->menu=array(
	array('label'=>'Create Categoriesp', 'url'=>array('create')),
	array('label'=>'Manage Categoriesp', 'url'=>array('admin')),
);
?>

<h1>Categoriesp</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
