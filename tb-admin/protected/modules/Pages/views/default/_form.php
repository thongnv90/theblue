<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pages-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'page_title',array('style'=>'float:left;')); ?>
            <a href="#" onclick="js:$('#page-title-en').slideToggle(); return false;" class="label-en">Dịch sang tiếng anh</a><br>
		<?php echo $form->textField($model,'page_title',array('size'=>60,'maxlength'=>255,'class'=>'span6')); ?>
	</div>
        <div class="row" id="page-title-en" style="display: none;">
		<?php echo $form->labelEx($model,'page_titleen'); ?>
		<?php echo $form->textField($model,'page_titleen',array('size'=>60,'maxlength'=>255,'class'=>'span6')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_content',array('style'=>'float:left;')); ?>
            <a href="#h" onclick="js:$('#page-content-en').slideToggle(); return false;" class="label-en">Dịch sang tiếng anh</a><br>
                <?php $this->widget('ckeditor.CKEditor', 
                        array( 'model'=>$model, 
                            'attribute'=>'page_content', 
                            'editorTemplate'=>'full', )); 
                ?> 
	</div>
	<div class="row" id="page-content-en" style="display: none;margin-top: 10px;">
		<?php echo $form->labelEx($model,'page_contenten'); ?>
                <?php $this->widget('ckeditor.CKEditor', 
                        array( 'model'=>$model, 
                            'attribute'=>'page_contenten', 
                            'editorTemplate'=>'full', )); 
                ?> 
	</div>
        <br>
	<div class="row">
		<?php echo $form->labelEx($model,'page_tag'); ?>
		<?php echo $form->textField($model,'page_tag',array('size'=>60,'maxlength'=>255,'class'=>'span4')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_parent'); ?>
		<?php echo Pages::model()->menuSelectPage(0,'',$model->page_parent); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_status'); ?>
		<?php echo $form->dropDownList($model,'page_status',  TBApplication::ArrStatus()); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->