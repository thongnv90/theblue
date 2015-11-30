<?php
/* @var $this MembersController */
/* @var $model Members */

/*Kiểm tra quyền update*/
$canUpdate = false;
if(YII::app()->user->id == $model->pr_primary_key)
    $canUpdate =true;
/*End Kiểm tra quyền update thông tin user */
$this->breadcrumbs=array(
	'Pr Members'=>array('index'),
	$model->pr_primary_key,
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->pr_primary_key)),
	array('label'=>'Delete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pr_primary_key),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h3>Thông tin tài khoản</h3>

<?php
    $this->widget('zii.widgets.CDetailView', array(
            'data'=>$model,
            'attributes'=>array(
                    'pr_member_email',
                    array(
                        'name'=>'pr_roles_id',
                        'type'=>'raw',
                        'value'=>  Roles::model()->findByPk($model->pr_roles_id)->pr_roles_name,
                    ),
                    array(
                        'name'=>'pr_member_active',
                        'type'=>'raw',
                        'value'=>function($data){
                            if($data->pr_member_status)
                                return Members::ACTIVE;
                            else
                                return Members::NOACTICE;
                        },
                    ),
            ),
    ));
?>
<br>
<?php if($canUpdate) { ?>
    <!-- ###Button thay đổi mật khẩu -->
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Thay đổi mật khẩu',
        'url'=>$this->createUrl('changePassword',array('id'=>$model->pr_primary_key)),
        'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'small', // null, 'large', 'small' or 'mini'
            )); ?>&nbsp;&nbsp;&nbsp;
     <!-- End Button thay đổi mật khẩu -->
<?php } ?>
     
     <!-- ###Button thay đổi tài khoản -->
    <?php
    if(Members::model()->getManagerSystem())
    {
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'sửa quyền',
            'url'=>$this->createUrl('updateAccount',array('id'=>$model->pr_primary_key)),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
        ));
    }
    ?>
     <!-- End Button thay đổi tài khoản -->

<h3>Thông tin cá nhân</h3>
<div>
    <div style="width:140px;float: left;">
        <div >
          <?php echo CHtml::image(MemberProfile::model()->getProfileUrl($model->pr_primary_key), 'images_user', array('width'=>'100','class'=>'images_circle','id'=>'member_images'))?>  
        </div>
        <br>
         <!-- ###Ajax thay đổi ảnh đại diện -->
        <?php
        if($canUpdate)
        {
            $this->widget('ext.EAjaxUpload.EAjaxUpload',
                    array(
                            'id'=>'uploadFile',
                            'config'=>array(
                                   'action'=>$this->createUrl('uploadMember',array('id'=>$model->memberProfile->pr_primary_key)),
                                   'allowedExtensions'=>array("jpg","jpeg","gif","png"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                   'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                                   'minSizeLimit'=>1*1024,// minimum file size in bytes
                                   'onComplete'=>"js:function(id, fileName, responseJSON){
                                       $('#member_images').attr('src','".Yii::app()->getBaseUrl()."/uploads/'+fileName);
                                       $('#uploadFile .qq-upload-list').html('');
                                    }",
                                   'messages'=>array(
                                                     'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                     'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                     'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                     'emptyError'=>"{file} is empty, please select files again without it.",
                                                     'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                                    ),
                                   'showMessage'=>"js:function(message){ alert(message); }"
                                  )
                    ));
        }

        ?>
         <!-- End thay đổi ảnh đại diện -->
    </div>
    <div style="width: 990px;float: left;">
        <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                        array(
                            'name'=>'Họ tên',
                            'type'=>'raw',
                            'value'=>$model->memberProfile->pr_member_profile_display_name,
                        ),
                        array(
                            'name'=>'Đại chỉ',
                            'type'=>'raw',
                            'value'=>$model->memberProfile->pr_member_profile_address,
                        ),
                        array(
                            'name'=>'Số điện thoại',
                            'type'=>'raw',
                            'value'=>$model->memberProfile->pr_member_profile_phone,
                        ),
                ),
        )); ?>
        <br><br>
        <!-- ###Button thay đổi thông tin thành viên -->
        <?php
        if($canUpdate)
        {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Sửa thông tin cá nhân',
                'url'=>$this->createUrl('updateInformation',array('id'=>$model->pr_primary_key)),
                'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'small', // null, 'large', 'small' or 'mini'
            ));
        }
        ?>
         <!-- End Button thay đổi thông tin thành viên -->
     </div>
</div>