<?php
/* @var $this CategoriespController */
/* @var $model Categoriesp */
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
		<?php echo $form->label($model,'cate_content'); ?>
		<?php echo $form->textArea($model,'cate_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_image'); ?>
		<?php echo $form->textField($model,'cate_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_sublink'); ?>
		<?php echo $form->textField($model,'cate_sublink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_createdate'); ?>
		<?php echo $form->textField($model,'cate_createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_status'); ?>
		<?php echo $form->textField($model,'cate_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_parent'); ?>
		<?php echo $form->textField($model,'cate_parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cate_order'); ?>
		<?php echo $form->textField($model,'cate_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->