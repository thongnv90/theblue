<?php
/* @var $this CategoriespController */
/* @var $model Categoriesp */

$this->breadcrumbs=array(
	'Categoriesp'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Categoriesp', 'url'=>array('index')),
	array('label'=>'Create Categoriesp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#categories-grid').yiiGridView('update', {
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
    <div class="ad-header-title"><h1><?php echo YII::t('lang','Danh mục sản phẩm'); ?></h1></div>
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

<?php $this->widget('bootstrap.widgets.TBGridView', array(
	'id'=>'categories-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'rowCssClassExpression'=>'"items[]_{$data->cate_id}"',
	'columns'=>array(
                array(
                    'header'=>'',
                    'type'=>'raw',
                    'value'=>'\'<i class="icon-move"></i>\'',
                    'headerHtmlOptions'=>array('style'=>'width:20px;'),
                    'htmlOptions'=>array('class'=>'cate-move')
                ),
		array(
                    'name'=>'cate_title',
                    'type'=>'raw',
                    'value'=>function($data){
                        return '<a href="'.$this->createUrl("admin",array("id"=>$data->cate_id)).'">'.$data->cate_title.'</a>';
                    },
                    'headerHtmlOptions'=>array('style'=>'width:220px;'),
                ),
		array(
                    'name'=>'cate_content',
                    'type'=>'raw',
                    'value'=>'$data->cate_content'
                ),
                array(
                    'name'=>'cate_image',
                    'type'=>'raw',
                    'value'=>function($data){
                        return '<img src="'.Yii::app()->baseUrl.'/uploads/'.$data->cate_image.'" alt="'.$data->cate_title.'" />'; 
                    }
                ),
                array(
                    'header'=>'Danh mục con',
                    'type'=>'raw',
                    'value'=>function($data){
                        $cate_child = Categoriesp::model()->getCategoryByParentId($data->cate_id);
                        foreach ($cate_child->data as $item) {
                            echo "<a href='".$this->createUrl('view',array('id'=>$item->cate_id))."'>".$item->cate_title."</a>, ";
                        }
                    }
                ),
		'cate_createdate',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                array(
                    'header'=>'<input type="checkbox" name="selectall" onclick="checkSelectAll()" id="selectall"/>',
                    'type'=>'raw',
                    'value'=>'\'<input type="checkbox" value="\'.$data->cate_id.\'" onclick="checkSelectCase()" name="case" class="case"/>\'',
                    'headerHtmlOptions'=>array(
                        'style'=>'width:40px; text-align:center;',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'text-align:center'
                    ),
                ), 
	),
)); 
                
$str_js = "
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
 
        $('#categories-grid table.items tbody').sortable({
            forcePlaceholderSize: true,
            forceHelperSize: true,
            cursor: 'move',
            handle: '.cate-move',
            items: 'tr',
            update : function () {
                serial = $('#categories-grid table.items tbody').sortable('serialize', {key: 'items[]', attribute: 'class'});
                $.ajax({
                    'url': '" . $this->createUrl('sortGridView') . "',
                    'type': 'post',
                    'data': serial,
                    'success': function(data){
                    },
                    'error': function(request, status, error){
                        alert('We are unable to set the sort order at this time.  Please try again in a few minutes.');
                    }
                });
            },
            helper: fixHelper
        }).disableSelection();
    ";
 
Yii::app()->clientScript->registerScript('sortable-categoy', $str_js);
              
?>
