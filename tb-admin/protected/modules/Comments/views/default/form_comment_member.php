<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>
<div class="form-comment">
        <div id="warning-<?php echo $parent; ?>" class="alert alert-warning alert-dismissible" role="alert" style="display: none">
        </div>
        <table>
            <tr>
                <td colspan="3">
                    <?php echo CHtml::textArea('comment_content_'.$parent,'',array('rows'=>4, 'cols'=>160,'class'=>'span6','placeholder'=>'Nội dung (bắt buộc)'),'id'); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo CHtml::textField('comment_name_'.$parent,'',array('class'=>'span3','placeholder'=>'Họ tên (bắt buộc)')); ?></td>
                <td><?php echo CHtml::textField('comment_email_'.$parent,'',array('class'=>'span3','placeholder'=>'Email (Để nhận thông báo khi có trả lời)')); ?></td>
                <td>
                    <?php $this->widget('bootstrap.widgets.TbButton',array(
                        'buttonType'=>'button',
                        'type'=>'info',
                        'label'=>'Gửi',
                        'htmlOptions'=>array(
                            'onclick'=>'AddComment('.$parent_root.','.$parent.');return false;',
                        ),
                    )); ?>
                </td>
            </tr>
        </table>

</div><!-- form -->
<script type="text/javascript">
    function AddComment(parent_root_id,parent_id){
        var name = $('#comment_name_'+parent_id).val();
        var email= $('#comment_email_'+parent_id).val();
        var content = $('#comment_content_'+parent_id).val();
        
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('/Comments/default/commentMember') ?>',
            beforeSend:function(){
//                if(validateEmail(email))
//                {
//                    return false;
//                }
            },
            data:{comment_name:name,comment_email:email,comment_content:content,parent_root:parent_root_id,
                    entry:'<?php echo $entry; ?>',entry_id:'<?php echo $entry_id; ?>'},    
            success:function(data){
                if(data=="success")
                {
                    $('#post_view_comment').load('<?php echo $this->createUrl('/Comments/default/viewListComment'); ?>',
                    {entry:'<?php echo $entry; ?>',entry_id:'<?php echo $entry_id; ?>'});
                    $("#post_form_comment .form-comment").show();
                }
                ShowError(data,parent_id);
            }
        });
    }
    function ShowError(content,parent_id){
        if(content!="" && content!="undefiled" && content!="success")
        {
            $('#warning-'+parent_id).html(content);
            $('#warning-'+parent_id).show();
        }
        else
        {
            $('#warning-'+parent_id).html(content);
            $('#warning-'+parent_id).hide();
        }
            
    }
</script>