<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'comment_id'); ?>
		<?php echo $form->textField($model,'comment_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_content'); ?>
		<?php echo $form->textArea($model,'comment_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_parent'); ?>
		<?php echo $form->textField($model,'comment_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_status'); ?>
		<?php echo $form->textField($model,'comment_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_create'); ?>
		<?php echo $form->textField($model,'comment_create'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment_memberid'); ?>
		<?php echo $form->textField($model,'comment_memberid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->