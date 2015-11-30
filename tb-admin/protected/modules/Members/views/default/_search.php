<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pr_primary_key'); ?>
		<?php echo $form->textField($model,'pr_primary_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_roles_id'); ?>
		<?php echo $form->textField($model,'pr_roles_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_member_email'); ?>
		<?php echo $form->textField($model,'pr_member_email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pr_member_status'); ?>
		<?php echo $form->textField($model,'pr_member_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->