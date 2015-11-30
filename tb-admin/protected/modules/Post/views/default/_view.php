<?php
/* @var $this PostController */
/* @var $data Post */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->post_id), array('view', 'id'=>$data->post_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_title')); ?>:</b>
	<?php echo CHtml::encode($data->post_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_titleen')); ?>:</b>
	<?php echo CHtml::encode($data->post_titleen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_summary')); ?>:</b>
	<?php echo CHtml::encode($data->post_summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_summaryen')); ?>:</b>
	<?php echo CHtml::encode($data->post_summaryen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_content')); ?>:</b>
	<?php echo CHtml::encode($data->post_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_contenten')); ?>:</b>
	<?php echo CHtml::encode($data->post_contenten); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('post_image')); ?>:</b>
	<?php echo CHtml::encode($data->post_image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_createdate')); ?>:</b>
	<?php echo CHtml::encode($data->post_createdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_memberid')); ?>:</b>
	<?php echo CHtml::encode($data->post_memberid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_sublink')); ?>:</b>
	<?php echo CHtml::encode($data->post_sublink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_typical')); ?>:</b>
	<?php echo CHtml::encode($data->post_typical); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_status')); ?>:</b>
	<?php echo CHtml::encode($data->post_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_order')); ?>:</b>
	<?php echo CHtml::encode($data->post_order); ?>
	<br />

	*/ ?>

</div>