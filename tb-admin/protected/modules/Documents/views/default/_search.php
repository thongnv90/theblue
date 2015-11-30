<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'document_id'); ?>
		<?php echo $form->textField($model,'document_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_entity'); ?>
		<?php echo $form->textField($model,'document_entity',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_title'); ?>
		<?php echo $form->textField($model,'document_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_sublink'); ?>
		<?php echo $form->textField($model,'document_sublink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_type'); ?>
		<?php echo $form->textField($model,'document_type',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_name'); ?>
		<?php echo $form->textField($model,'document_name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_url'); ?>
		<?php echo $form->textField($model,'document_url',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_icon'); ?>
		<?php echo $form->textField($model,'document_icon',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_createdate'); ?>
		<?php echo $form->textField($model,'document_createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_order'); ?>
		<?php echo $form->textField($model,'document_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_createby'); ?>
		<?php echo $form->textField($model,'document_createby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'document_status'); ?>
		<?php echo $form->textField($model,'document_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->