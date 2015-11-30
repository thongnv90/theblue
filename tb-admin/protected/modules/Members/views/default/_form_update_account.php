<?php
/*
 * @var $this Defaultcontrol
 * @var $model Member
 */
?>
<h1>Thay đổi quyền</h1>
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
<?php $rolesArray = Roles::model()->GetRoles(Roles::PR_QUERY_RETURN_TYPE_DROPDOWN_ARRAY); ?>
<p class="note">Các trường đánh dấu <span class="required">*</span> là bắt buộc.</p>
<!--	<div>
                <?php echo $form->textFieldRow($model,'pr_member_email',array('size'=>60,'maxlength'=>255)); ?>
                <?php //echo $form->error($model,'pr_member_email'); ?>
	</div>-->
        <div>
                <?php echo $form->dropDownListRow($model,'pr_roles_id',$rolesArray); ?>
                <?php echo $form->error($model,'pr_roles_id'); ?>
        </div> 
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

