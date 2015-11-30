<?php
/* @var $this CategoriesController */
/* @var $model Categories */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categories-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cate_title'); ?>
		<?php echo $form->textField($model,'cate_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
                <?php
                    $this->widget('application.extensions.cleditor.ECLEditor', array(
                        'model'=>$model,
                        'attribute'=>'cate_summany', //Model attribute name. Nome do atributo do modelo.
                        'options'=>array(
                            'width'=>'700',
                            'height'=>200,
                            'useCSS'=>true,
                        ),
                        'value'=>$model->cate_summany, //If you want pass a value for the widget. I think you will. Se você precisar passar um valor para o gadget. Eu acho irá.
                    ));
                ?>
	</div>
        
	<div class="row">
                <?php 
                    $parent_arr = array(''=>'');
                    $parent_arr = $parent_arr + Categories::model()->getArrayCateByParent();
                ?>
		<?php echo $form->labelEx($model,'cate_parent'); ?>
		<?php echo $form->dropDownList($model,'cate_parent', $parent_arr) ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'cate_status'); ?>
		<?php echo $form->dropDownList($model,'cate_status',  TBApplication::ArrStatus()); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->