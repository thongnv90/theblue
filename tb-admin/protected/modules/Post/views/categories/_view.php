<?php
/* @var $this CategoriesController */
/* @var $data Categories */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cate_id), array('view', 'id'=>$data->cate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_title')); ?>:</b>
	<?php echo CHtml::encode($data->cate_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_summany')); ?>:</b>
	<?php echo CHtml::encode($data->cate_summany); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_sublink')); ?>:</b>
	<?php echo CHtml::encode($data->cate_sublink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_order')); ?>:</b>
	<?php echo CHtml::encode($data->cate_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_status')); ?>:</b>
	<?php echo CHtml::encode($data->cate_status); ?>
	<br />


</div>