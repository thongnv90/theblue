<?php
/* @var $this MembersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Thành viên',
);

//$this->menu=array(
//	array('label'=>'Create Members', 'url'=>array('create')),
//	array('label'=>'Manage Members', 'url'=>array('admin')),
//);
//?>
<h1>Thành viên
        <?php
            $disable = "style=\"display:none;\" readonly";
            if(Members::model()->getManagerSystem())
            {
                $this->widget('bootstrap.widgets.TbButton',array(
                            'label'=>'<i class="icon-plus"></i>&nbsp;Thêm thành viên',
                            'type'=>'none',
                            'size'=>'normal',
                            'encodeLabel'=>false,
                            'buttonType'=>'link',
                            'url'=>$this->createUrl('create'),
                ));
                $disable="";
            }
        ?>
</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'id'=>'gridview-members',
	'dataProvider'=>$dataProvider,
	'type'=>'striped bordered condensed',
        'template'=>"{items}{pager}",
        'columns'=>array(
            array(
                'header'=>'<input type="checkbox" name="case" id="selectall" value="" />',
                'type'=>'raw',
                'value'=>'\'<input type="checkbox" name="case" class="case" value="$data->pr_primary_key" />\''
            ),
            array(
                'header'=>'#',
                'type'=>'raw',
                'name'=>'pr_primary_key',
                'value'=>'$data->pr_primary_key',
            ),
            array(
                'header'=>'Tài khoản',
                'type'=>'raw',
                'name'=>'pr_username',
                'value'=>'$data->pr_username',
            ),
            array(
                'header'=>'Tên thành viên',
                'type'=>'raw',
                'value'=>'\'<a href="\'.YII::app()->createUrl("Members/default/view",array("id"=>$data->pr_primary_key)).\'">\'.$data->memberProfile->pr_member_profile_display_name.\'</a>\'',
            ),
            array(
                'header'=>'Email',
                'type'=>'raw',
                'name'=>'pr_member_email',
                'value'=>'$data->pr_member_email',
            ),
            array(
                'header'=>'Actions',
                'headerHtmlOptions'=>array('style'=>'text-align:center;width:120px'),
                'htmlOptions'=>array('style'=>'text-align:center'),
                'type'=>'raw',
                'value'=>'($data->pr_member_status) ? '
                . '\'<a href="#" id="member_delete" '.$disable.' onclick="ajaxDeleteMember(\'.$data->pr_primary_key.\');return false;" data-original-title="Xóa" rel="tooltip" title><i class="icon-trash"></i></a>
                    <a href="#" id="member_delete" '.$disable.' onclick="ajaxClockMember(\'.$data->pr_primary_key.\',0)" data-original-title="Khóa" rel="tooltip" title><i class="icon-unlock"></i></a>\''
                . ': \'<a href="#" id="member_delete" '.$disable.' onclick="ajaxDeleteMember(\'.$data->pr_primary_key.\');return false;" data-original-title="Xóa" rel="tooltip" title><i class="icon-trash"></i></a>
                    <a href="#" id="member_delete" '.$disable.' onclick="ajaxClockMember(\'.$data->pr_primary_key.\',1)" data-original-title="Khóa" rel="tooltip" title><i class="icon-lock"></i></a>\'',
            )
        ),
));
?>

<script type="text/javascript">
    function ajaxDeleteMember(member_id)
    {
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('delete'); ?>',
            beforeSend: function(){
                if(confirm('Bạn có chắc muốn xóa thành viên này không?'))
                    return true;
                return false;
            },
            data:{member_id:member_id},
            success: function(data){
                var responseJSON = jQuery.parseJSON(data);
                if(responseJSON.error)
                    alert(responseJSON.error);
                else
                    $.fn.yiiGridView.update("gridview-members");
            },
        });
    }
    function ajaxClockMember(member_id,status_id)
    {
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('clockMember'); ?>',
            beforeSend: function(){
                //code;
            },
            data:{member_id:member_id,status_id:status_id},
            success: function(data){
                var responseJSON = jQuery.parseJSON(data);
                $.fn.yiiGridView.update("gridview-members");
                if(responseJSON.status=="clock")
                    alert('Khóa thành công.');
                else
                    alert('Mở khóa thành công');
            }
        });
    }
</script>