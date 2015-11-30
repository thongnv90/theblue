<?php
/*
 * @var $this Defaultcontrol
 * @var $model Member
 */
?>
<h1>Thay đổi mật khẩu</h1>
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
        <div class="help-inline error" id="pr_member_password_confirm_error"><?php echo $error['blank']; ?></div>
        <div class="control-group ">
            <div>
                <?php echo CHtml::label('Mật khẩu hiện tại <span class="required">*</span>', 'pr_member_current_password',array('class'=>'control-label required')) ?>
            </div>
            <div class="controls">
                <?php echo CHtml::passwordField('Member[pr_member_current_password]', '') ?>
                <div class="help-inline error" id="pr_member_password_confirm_error"><?php echo $error['current']; ?></div>
            </div>
        </div>
        <div class="control-group ">
            <div>
                <?php echo CHtml::label('Mật khẩu mới <span class="required">*</span>', 'pr_member_new_password',array('class'=>'control-label required')) ?>
            </div>
            <div class="controls">
                <?php echo CHtml::passwordField('Member[pr_member_new_password]', '') ?>
                <div class="help-inline error" id="pr_member_password_confirm_error"><?php echo $error['confirm'].$error['eval']; ?></div>
            </div>
        </div>
        <div class="control-group ">
            <div>
                <?php echo CHtml::label('Xác nhận mật khẩu <span class="required">*</span>', 'pr_member_confirm_password',array('class'=>'control-label required')) ?>
            </div>
            <div class="controls">
                <?php echo CHtml::passwordField('Member[pr_member_confirm_password]', '') ?>
                <div class="help-inline error" id="pr_member_password_confirm_error"></div>
            </div>
        </div>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton',array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'Save',
                'ajaxOptions'=>array(
                    'type'=>'POST',
                ),
            )); ?>
	</div>
<?php $this->endWidget(); ?>