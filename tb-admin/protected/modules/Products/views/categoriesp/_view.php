<?php
/* @var $this CategoriespController */
/* @var $data Categoriesp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cate_id), array('view', 'id'=>$data->cate_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_title')); ?>:</b>
	<?php echo CHtml::encode($data->cate_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_content')); ?>:</b>
	<?php echo CHtml::encode($data->cate_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_image')); ?>:</b>
	<?php echo CHtml::encode($data->cate_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_sublink')); ?>:</b>
	<?php echo CHtml::encode($data->cate_sublink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_createdate')); ?>:</b>
	<?php echo CHtml::encode($data->cate_createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_status')); ?>:</b>
	<?php echo CHtml::encode($data->cate_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_parent')); ?>:</b>
	<?php echo CHtml::encode($data->cate_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cate_order')); ?>:</b>
	<?php echo CHtml::encode($data->cate_order); ?>
	<br />

	*/ ?>

</div>