<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $memberProfileModel MemberProfile */
/* @var $form CActiveForm */
?>

<div class="form">

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

	<?php $rolesArray = Roles::model()->GetRoles(Roles::PR_QUERY_RETURN_TYPE_DROPDOWN_ARRAY); ?>

	<div>
                <?php echo $form->textFieldRow($model,'pr_username',array('size'=>60,'maxlength'=>50)); ?>
                <?php //echo $form->error($model,'pr_member_email'); ?>
	</div>
	<div>
                <?php echo $form->textFieldRow($model,'pr_member_email',array('size'=>60,'maxlength'=>255)); ?>
                <?php //echo $form->error($model,'pr_member_email'); ?>
	</div>
        <div>
                <?php echo $form->textFieldRow($memberProfileModel,'pr_member_profile_display_name'); ?>
                <?php echo $form->error($model,'pr_member_profile_display_name'); ?>
        </div> 
        <div>
                <?php echo $form->dropDownListRow($model,'pr_roles_id',$rolesArray); ?>
                <?php echo $form->error($model,'pr_roles_id'); ?>
        </div> 
	<div>
		<?php echo $form->passwordFieldRow($model,'pr_member_password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'pr_member_password'); ?>
	</div>
        <div class="control-group ">
            <div>
                <?php echo CHtml::label('Xác nhận mật khẩu <span class="required">*</span>', 'pr_member_password_confirm',array('class'=>'control-label required')) ?>
            </div>
            <div class="controls">
                <?php echo CHtml::passwordField('pr_member_password_confirm', '') ?>
                <div class="help-inline error" id="pr_member_password_confirm_error"></div>
            </div>
        </div>
	<div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton',array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>$model->isNewRecord ? 'Thêm' : 'Save',
                'ajaxOptions'=>array(
                    'type'=>'POST',
                ),
            )); ?>
	</div>

<?php $this->endWidget(); ?>
<?php //echo $model->generaSalt("123"); ?>
</div><!-- form -->