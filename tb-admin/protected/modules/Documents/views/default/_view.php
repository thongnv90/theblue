<?php
/* @var $this DocumentController */
/* @var $data Document */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->document_id), array('view', 'id'=>$data->document_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_entity')); ?>:</b>
	<?php echo CHtml::encode($data->document_entity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_title')); ?>:</b>
	<?php echo CHtml::encode($data->document_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_sublink')); ?>:</b>
	<?php echo CHtml::encode($data->document_sublink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_type')); ?>:</b>
	<?php echo CHtml::encode($data->document_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_name')); ?>:</b>
	<?php echo CHtml::encode($data->document_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_url')); ?>:</b>
	<?php echo CHtml::encode($data->document_url); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('document_icon')); ?>:</b>
	<?php echo CHtml::encode($data->document_icon); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_createdate')); ?>:</b>
	<?php echo CHtml::encode($data->document_createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_order')); ?>:</b>
	<?php echo CHtml::encode($data->document_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_createby')); ?>:</b>
	<?php echo CHtml::encode($data->document_createby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('document_status')); ?>:</b>
	<?php echo CHtml::encode($data->document_status); ?>
	<br />

	*/ ?>

</div>