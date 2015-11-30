<?php
/* @var $this DocumentController */
/* @var $model Document */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'document-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'document_entity'); ?>
		<?php echo $form->textField($model,'document_entity',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'document_entity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_title'); ?>
		<?php echo $form->textField($model,'document_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_sublink'); ?>
		<?php echo $form->textField($model,'document_sublink',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document_sublink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_type'); ?>
		<?php echo $form->textField($model,'document_type',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'document_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_name'); ?>
		<?php echo $form->textField($model,'document_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_url'); ?>
		<?php echo $form->textField($model,'document_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'document_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_icon'); ?>
		<?php echo $form->textField($model,'document_icon',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'document_icon'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_createdate'); ?>
		<?php echo $form->textField($model,'document_createdate'); ?>
		<?php echo $form->error($model,'document_createdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_order'); ?>
		<?php echo $form->textField($model,'document_order'); ?>
		<?php echo $form->error($model,'document_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_createby'); ?>
		<?php echo $form->textField($model,'document_createby'); ?>
		<?php echo $form->error($model,'document_createby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document_status'); ?>
		<?php echo $form->textField($model,'document_status'); ?>
		<?php echo $form->error($model,'document_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->