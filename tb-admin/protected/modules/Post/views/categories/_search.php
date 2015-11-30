<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cate_id'); ?>
		<?php echo $form->textField($model,'cate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_title'); ?>
		<?php echo $form->textField($model,'cate_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_summany'); ?>
		<?php echo $form->textArea($model,'cate_summany',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_sublink'); ?>
		<?php echo $form->textField($model,'cate_sublink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_order'); ?>
		<?php echo $form->textField($model,'cate_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_status'); ?>
		<?php echo $form->textField($model,'cate_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->