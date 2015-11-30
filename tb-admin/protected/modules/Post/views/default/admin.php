<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#post-grid').yiiGridView('update', {
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
    <div class="ad-header-title"><h1><?php echo YII::t('lang','Bài viết'); ?></h1></div>
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
                        'label'=>'<i class="icon-align-justify"></i>&nbsp;'.YII::t('lang','Danh mục'),
                        'type'=>'none',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'link',
                        'htmlOptions'=>array('data-workspace'=>'1'),
                        'url'=>  $this->createUrl('Categories/admin'),
            ));
            
            $this->widget('bootstrap.widgets.TbButton',array(
                        'label'=>'<i class="icon-trash"></i>&nbsp;'.YII::t('lang','Xóa nhiều'),
                        'type'=>'danger',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'button',
                        'htmlOptions'=> array('onclick' => 'DeleteAllPost()'),
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

<?php $this->widget('bootstrap.widgets.TbGridview', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'type'=>'striped condensed',
        'template'=>"{items}{pager}",
	'columns'=>array(
                array(
                    'name'=>'post_title',
                    'type'=>'raw',
                    'value'=>'$data->post_title'
                ),
                array(
                    'name'=>'post_summary',
                    'type'=>'raw',
                    'value'=>'$data->post_summary'
                ),
                array(
                    'name'=>'post_content',
                    'type'=>'raw',
                    'value'=>'$data->post_content'
                ),
		array(
                   'name'=>'post_image',
                   'type'=>'raw',
                   'filter'=>FALSE,
                   'value'=>function($data){
                        return '<img height="80" src="'.Yii::app()->baseUrl.'/uploads/'.$data->post_image.'" alt="'.$data->post_title.'" />';
                   }
                ),
		array(
                    'name'=>'post_createdate',
                    'type'=>'raw',
                    'value'=>'date(TBApplication::getFormatDate(),strtotime($data->post_createdate))',
                    'filter'=>false,
                ),
                array(
                    'type'=>'raw',
                    'name'=>'post_typical',
                    'filter'=>FALSE,
                    'value'=>  function ($data){
                        if($data->post_typical==0)
                            return '<a href="#" onclick="updatePostTypical('.$data->post_id.',1)"><i class="icon-remove"></i></a>';
                        else
                            return '<a href="#" onclick="updatePostTypical('.$data->post_id.',0)"><i class="icon-ok"></i></a>';
                    }
                ),
                array(
                    'type'=>'raw',
                    'name'=>'post_status',
                    'filter'=>FALSE,
                    'value'=>  function ($data){
                        if($data->post_status==0)
                            return '<a href="#" onclick="updatePostStatus('.$data->post_id.',1)"><i class="icon-remove"></i></a>';
                        else
                            return '<a href="#" onclick="updatePostStatus('.$data->post_id.',0)"><i class="icon-ok"></i></a>';
                    }
                ),
                array(
                    'type'=>'raw',
                    'name'=>'post_memberid',
                    'value'=>'$data->post_memberid',
                    'filter'=>CHtml::activeDropDownList(
                        $model,
                        "post_memberid",
                        CHtml::listData(Members::model()->findAll(), 'pr_primary_key', 'pr_username'),
                        array(
                            'empty'=>'All',
                    )),
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                array(
                    'header'=>'<input type="checkbox" name="selectall" onclick="checkSelectAll()" id="selectall"/>',
                    'type'=>'raw',
                    'value'=>'\'<input type="checkbox" value="\'.$data->post_id.\'" onclick="checkSelectCase()" name="case" class="case"/>\'',
                    'headerHtmlOptions'=>array(
                        'style'=>'width:40px; text-align:center;',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'text-align:center'
                    ),
                ), 
	),
)); ?>
<script>
    function updatePostTypical(post_id,typical){
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('updatePostTypical'); ?>',
            data:{post_id:post_id,typical:typical},
            success:function(data){
                $.fn.yiiGridView.update("post-grid");
            }
        });
    }
    
    function DeleteAllPost(){
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
                    $.fn.yiiGridView.update("post-grid");
                    $('#content').unblock();
                },
        });
    }
    
    function updatePostStatus(post_id,status){
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('updatePostStatus'); ?>',
            data:{post_id:post_id,status:status},
            success:function(data){
                $.fn.yiiGridView.update("post-grid");
            }
        });
    }
</script>