<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'post_id'); ?>
		<?php echo $form->textField($model,'post_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_title'); ?>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_titleen'); ?>
		<?php echo $form->textField($model,'post_titleen',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_summary'); ?>
		<?php echo $form->textArea($model,'post_summary',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_summaryen'); ?>
		<?php echo $form->textArea($model,'post_summaryen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_content'); ?>
		<?php echo $form->textArea($model,'post_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_contenten'); ?>
		<?php echo $form->textArea($model,'post_contenten',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_image'); ?>
		<?php echo $form->textField($model,'post_image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_createdate'); ?>
		<?php echo $form->textField($model,'post_createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_memberid'); ?>
		<?php echo $form->textField($model,'post_memberid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_sublink'); ?>
		<?php echo $form->textField($model,'post_sublink'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_typical'); ?>
		<?php echo $form->textField($model,'post_typical'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_status'); ?>
		<?php echo $form->textField($model,'post_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'post_order'); ?>
		<?php echo $form->textField($model,'post_order'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->