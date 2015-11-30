<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-grid').yiiGridView('update', {
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
    <div class="ad-header-title"><h1><?php echo YII::t('lang','Trang'); ?></h1></div>
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
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
        'type'=>'striped condensed',
        'template'=>"{items}{pager}",
	'columns'=>array(
                array(
                    'header'=>'<input type="checkbox" name="selectall" onclick="checkSelectAll()" id="selectall"/>',
                    'type'=>'raw',
                    'value'=>'\'<input type="checkbox" value="\'.$data->page_id.\'" onclick="checkSelectCase()" name="case" class="case"/>\'',
                ),
		'page_id',
                array(
                    'type'=>'raw',
                    'name'=>'page_title',
                    'value'=>'$data->page_title',
                ),
                array(
                    'type'=>'raw',
                    'name'=>'page_content',
                    'value'=>'$data->page_content',
                ),
                array(
                    'type'=>'raw',
                    'name'=>'page_tag',
                    'value'=>'$data->page_tag',
                ),
                array(
                    'type'=>'raw',
                    'name'=>'page_createdate',
                    'value'=>'date(TBApplication::getFormatDate(),strtotime($data->page_createdate))',
                ),
                array(
                    'header'=>'Trạng thái',
                    'type'=>'raw',
                    'value'=>function($data){
                        if($data->page_status == 1)
                            echo '<a href="#" onclick="updateStatus('.$data->page_id.',0)"><i class="icon-ok"></i></a>';
                        else
                            echo '<a href="#" onclick="updateStatus('.$data->page_id.',1)"><i class="icon-remove"></i></a>';
                    },
                    'headerHtmlOptions'=>array('style'=>'text-align:center','width'=>'70'),
                    'htmlOptions'=>array('style'=>'text-align:center')
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'afterDelete' => 'function(link,success,data) {return false; }'
		),
	),
)); ?>
<div class="ad-footer-action">
        <?php 
            $this->widget('bootstrap.widgets.TbButton',array(
                        'label'=>'<i class="icon-remove"></i>&nbsp;'.YII::t('lang','Xóa'),
                        'type'=>'danger',
                        'size'=>'normal',
                        'encodeLabel'=>false,
                        'buttonType'=>'button',
                        'htmlOptions'=> array('onclick' => 'DeleteAllPage()'),
            ));
        ?>
    </div>

<script type="text/javascript">
    function DeleteAllPage(){
        var arr_page_id = getIDSelectInput();
        $.ajax({
                type: 'Post',
                url: '<?php echo $this->createURL("deleteAll"); ?>',
                data:arr_page_id,
                beforeSend:function(){
                    
                    if(arr_page_id =="" )
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
                    $.fn.yiiGridView.update("pages-grid");
                    $('#content').unblock();
                },
        });
    }
    
    function updateStatus(page_id,status){
            $.ajax({
                type: 'Post',
                url: '<?php echo $this->createURL("updateStatus"); ?>',
                data:{page_id:page_id,status:status},
                success:function(data){ 
                    $.fn.yiiGridView.update("pages-grid");
                    $('#content').unblock();
                },
        });
    }
</script>