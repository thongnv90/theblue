<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'pro_id'); ?>
		<?php echo $form->textField($model,'pro_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_cateidarr'); ?>
		<?php echo $form->textField($model,'pro_cateidarr',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_title'); ?>
		<?php echo $form->textField($model,'pro_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_titleen'); ?>
		<?php echo $form->textField($model,'pro_titleen',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_images'); ?>
		<?php echo $form->textField($model,'pro_images',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_summary'); ?>
		<?php echo $form->textArea($model,'pro_summary',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_summaryen'); ?>
		<?php echo $form->textArea($model,'pro_summaryen',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_content'); ?>
		<?php echo $form->textArea($model,'pro_content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_contenten'); ?>
		<?php echo $form->textArea($model,'pro_contenten',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_specifications'); ?>
		<?php echo $form->textArea($model,'pro_specifications',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_price'); ?>
		<?php echo $form->textField($model,'pro_price',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_discountprice'); ?>
		<?php echo $form->textField($model,'pro_discountprice',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_typical'); ?>
		<?php echo $form->textField($model,'pro_typical'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_sublink'); ?>
		<?php echo $form->textField($model,'pro_sublink',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_status'); ?>
		<?php echo $form->textField($model,'pro_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_order'); ?>
		<?php echo $form->textField($model,'pro_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pro_createdate'); ?>
		<?php echo $form->textField($model,'pro_createdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->