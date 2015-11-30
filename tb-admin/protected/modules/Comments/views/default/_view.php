<?php
/* @var $this CommentController */
/* @var $data Comment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->comment_id), array('view', 'id'=>$data->comment_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_content')); ?>:</b>
	<?php echo CHtml::encode($data->comment_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_parent')); ?>:</b>
	<?php echo CHtml::encode($data->comment_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_status')); ?>:</b>
	<?php echo CHtml::encode($data->comment_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_create')); ?>:</b>
	<?php echo CHtml::encode($data->comment_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment_memberid')); ?>:</b>
	<?php echo CHtml::encode($data->comment_memberid); ?>
	<br />


</div>