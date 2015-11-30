<?php
/* @var $this MembersController */
/* @var $data Members */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_primary_key')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->pr_primary_key), array('view', 'id'=>$data->pr_primary_key)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_roles_id')); ?>:</b>
	<?php echo CHtml::encode($data->pr_roles_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_member_email')); ?>:</b>
	<?php echo CHtml::encode($data->pr_member_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_member_password')); ?>:</b>
	<?php echo CHtml::encode($data->pr_member_password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr_member_states')); ?>:</b>
	<?php echo CHtml::encode($data->pr_member_states); ?>
	<br />


</div>