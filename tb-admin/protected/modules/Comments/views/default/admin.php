<?php
/* @var $this DefaultController */
/* @var $model Comment */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#comment-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="ad_header">
    <div class="ad-header-back">
        <a href="#" onclick="goBack(); return false;"><i class="icontb-left"></i></a>
        <a href="#" onclick="reload(); return false;"><i class="icontb-reload"></i></a>
        <a href="#" onclick="goNext(); return false;"><i class="icontb-right"></i></a>
    </div>
    <div class="ad-header-title"><h1><?php echo YII::t('lang','Phản hồi'); ?></h1></div>
    <div class="ad-header-action">
        <?php 
            $this->widget('bootstrap.widgets.TbButton',array(
                        'label'=>'<i class="icon-plus"></i>&nbsp;'.YII::t('lang','Thêm'),
                        'type'=>'none',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'link',
                        'htmlOptions'=>array('data-workspace'=>'1'),
                        'url'=>  $this->createUrl('create'),
            ));
            
            $this->widget('bootstrap.widgets.TbButton',array(
                        'label'=>'<i class="icon-trash"></i>&nbsp;'.YII::t('lang','Xóa nhiều'),
                        'type'=>'danger',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'button',
                        'htmlOptions'=> array('onclick' => 'DeleteAllComment()'),
            ));
        ?>
    </div>
</div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped condensed',
        'template'=>"{items}{pager}",
	'columns'=>array(
                array(
                    'type'=>'raw',
                    'name'=>'comment_name',
                    'value'=>function($data){
                        $html='<div>'
                                . ($data->comment_memberid ? $data->comment_memberid : $data->comment_name.'<br>'.
                                $data->comment_email)
                              . '</div>';
                        return $html;
                    },
                ),
                array(
                    'type'=>'raw',
                    'name'=>'comment_content',
                    'value'=>'$data->comment_content',
                ),
                array(
                    'header'=>Yii::t('lang','Phản hồi cho'),
                    'type'=>'raw',
                    'name'=>'comment_parent',
                    'value'=>'$data->comment_parent',
                ),         
                array(
                    'type'=>'raw',
                    'name'=>'comment_status',
                    'value'=>function($data){
                        echo CHtml::dropDownList('coment-status', $data->comment_status, Comment::getStatusComment(),array('class'=>'span2'));
                    },
                ),
  
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                array(
                    'header'=>'<input type="checkbox" name="selectall" onclick="checkSelectAll()" id="selectall"/>',
                    'type'=>'raw',
                    'value'=>'\'<input type="checkbox" value="\'.$data->comment_id.\'" onclick="checkSelectCase()" name="case" class="case"/>\'',
                ),        
	),
)); ?>
<script type="text/javascript">
    function DeleteAllComment(){
        var arr_post_id = getIDSelectInput();
        $.ajax({
                type: 'Post',
                url: '<?php echo $this->createURL("deleteAll"); ?>',
                data:arr_post_id,
                beforeSend:function(){
                    
                    if(arr_post_id =="" )
                    {
                        alert("Bạn chưa chọn record nào để xóa");
                        $('#content').unblock();
                        return false;
                    }
                    else if(confirm('Bạn có muốn xóa record này không?')){
                        $('#content').block();
                        return true;
                    }
                    else{
                        $('#content').unblock();
                        return false;
                    }
                },
            //'processData' => false,
                success:function(data){ 
                    $.fn.yiiGridView.update("comment-grid");
                    $('#content').unblock();
                },
        });
    }
</script>