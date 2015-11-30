<?php
/* @var $this ProductsController */
/* @var $data Products */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pro_id), array('view', 'id'=>$data->pro_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_cateidarr')); ?>:</b>
	<?php echo CHtml::encode($data->pro_cateidarr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_title')); ?>:</b>
	<?php echo CHtml::encode($data->pro_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_titleen')); ?>:</b>
	<?php echo CHtml::encode($data->pro_titleen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_images')); ?>:</b>
	<?php echo CHtml::encode($data->pro_images); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_summary')); ?>:</b>
	<?php echo CHtml::encode($data->pro_summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_summaryen')); ?>:</b>
	<?php echo CHtml::encode($data->pro_summaryen); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_content')); ?>:</b>
	<?php echo CHtml::encode($data->pro_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_contenten')); ?>:</b>
	<?php echo CHtml::encode($data->pro_contenten); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_specifications')); ?>:</b>
	<?php echo CHtml::encode($data->pro_specifications); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_price')); ?>:</b>
	<?php echo CHtml::encode($data->pro_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_discountprice')); ?>:</b>
	<?php echo CHtml::encode($data->pro_discountprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_typical')); ?>:</b>
	<?php echo CHtml::encode($data->pro_typical); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_sublink')); ?>:</b>
	<?php echo CHtml::encode($data->pro_sublink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_status')); ?>:</b>
	<?php echo CHtml::encode($data->pro_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_order')); ?>:</b>
	<?php echo CHtml::encode($data->pro_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pro_createdate')); ?>:</b>
	<?php echo CHtml::encode($data->pro_createdate); ?>
	<br />

	*/ ?>

</div>