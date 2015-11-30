<?php
/*
 * @var $this Defaultcontrol
 * @var $model Member
 */
?>
<h1>Thay đổi thông tin cá nhân</h1>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'pr-members-form',
        'type'=>'horizontal',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'afterValidate'=>'js:function()
                                {
                                    if(confirmPassword()==false)
                                        return false;
                                    return true;
                                }',
        ),
)); ?>
<p class="note">Các trường đánh dấu <span class="required">*</span> là bắt buộc.</p>
        <?php //echo $form->textFieldRow($model,'pr_member_profile_surname'); ?>
        <?php //echo $form->textFieldRow($model,'pr_member_profile_given_name'); ?>
        <?php echo $form->textFieldRow($model,'pr_member_profile_display_name',array('class'=>'span4'))?>
        <?php echo $form->textFieldRow($model,'pr_member_profile_phone',array('class'=>'span4'))?>
        <?php echo $form->textAreaRow($model,'pr_member_profile_address',array('class'=>'span6','rows'=>'5'))?>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton',array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Create' : 'Save',
                'ajaxOptions'=>array(
                    'type'=>'POST',
                ),
            )); ?>
	</div>
<?php $this->endWidget(); ?>