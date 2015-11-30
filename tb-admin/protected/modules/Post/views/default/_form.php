<?php
/* @var $this DefaultController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model,'post_title',array('style'=>'float:left;')); ?>
                <a href="#" onclick="js:$('#post-title-en').slideToggle(); return false;" class="label-en">Dịch sang tiếng anh</a><br>
		<?php echo $form->textField($model,'post_title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="control-group" id="post-title-en" style="display: none;">
		<?php echo $form->labelEx($model,'post_titleen'); ?>
		<?php echo $form->textField($model,'post_titleen',array('size'=>60,'maxlength'=>255)); ?>
	</div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'post_cateidarr'); ?>
            <div class="controls">
                <?php
                    $cate_arr = explode(',',$model->post_cateidarr);
                    $selected = array();
                    for($i=0;$i<count($cate_arr);$i++)
                    {
                        $selected[$cate_arr[$i]] = array('selected' => 'selected');
                    }
                    $this->widget('ext.select2.ESelect2',array(
                            'model'=>$model,
                            'attribute'=>'post_cateidarr',
                            'data'=> Categories::model()->getArrayCateByParent(),
                            'htmlOptions'=>array(
                                'multiple'=>'multiple',
                                'style'=>'width:556px;',
                                'options' => $selected,
                                'placeholder'=>'Select danh mục'
                            ),
                    ));
                ?>     
            </div>
        </div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'post_image',array('class'=>"control-label")); ?>
            <div class="controls-row">
		<?php echo $form->fileField($model,'post_image'); ?>
            </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'post_summary',array('style'=>'float:left;')); ?>
                <a href="#" onclick="js:$('#post-summary-en').slideToggle(); return false;" class="label-en">Dịch sang tiếng anh</a><br>
                <?php
                    $this->widget('application.extensions.cleditor.ECLEditor', array(
                        'model'=>$model,
                        'attribute'=>'post_summary', //Model attribute name. Nome do atributo do modelo.
                        'options'=>array(
                            'width'=>'700',
                            'height'=>200,
                            'useCSS'=>true,
                        ),
                        'value'=>$model->post_summary, //If you want pass a value for the widget. I think you will. Se você precisar passar um valor para o gadget. Eu acho irá.
                    ));
                ?>
	</div>

	<div class="control-group" id="post-summary-en" style="display: none;">
		<?php echo $form->labelEx($model,'post_summaryen'); ?>
                <?php
                    $this->widget('application.extensions.cleditor.ECLEditor', array(
                        'model'=>$model,
                        'attribute'=>'post_summaryen', //Model attribute name. Nome do atributo do modelo.
                        'options'=>array(
                            'width'=>'700',
                            'height'=>200,
                            'useCSS'=>true,
                        ),
                        'value'=>$model->post_summaryen, //If you want pass a value for the widget. I think you will. Se você precisar passar um valor para o gadget. Eu acho irá.
                    ));
                ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'post_content',array('style'=>'float:left;')); ?>
                <a href="#" onclick="js:$('#post-content-en').slideToggle(); return false;" class="label-en">Dịch sang tiếng anh</a><br>
                <?php $this->widget('ckeditor.CKEditor', 
                        array( 'model'=>$model, 
                            'attribute'=>'post_content', 
                            'editorTemplate'=>'full', )); 
                ?> 
	</div>

	<div class="control-group" id="post-content-en" style="display: none;">
		<?php echo $form->labelEx($model,'post_contenten'); ?>
                <?php $this->widget('ckeditor.CKEditor', 
                        array( 'model'=>$model, 
                            'attribute'=>'post_contenten', 
                            'editorTemplate'=>'full', )); 
                ?> 
	</div>


	<div class="control-group">
		<?php echo $form->labelEx($model,'post_typical',array('style'=>'float:left')); ?>
		<?php echo $form->checkBox($model,'post_typical'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'post_status'); ?>
		<?php echo $form->dropDownList($model,'post_status', TBApplication::ArrStatus()); ?>
	</div>
	<div class="control-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->