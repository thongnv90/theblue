<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Create Products', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#products-grid').yiiGridView('update', {
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
    <div class="ad-header-title"><h1><?php echo YII::t('lang','Sản phẩm'); ?></h1></div>
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
                        'url'=>  $this->createUrl('Categoriesp/admin'),
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
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'type'=>'raw',
                    'name'=>'pro_id',
                    'filter'=>false,
                    'value'=>'$data->pro_id',
                ),
                array(
                    'type'=>'raw',
                    'name'=>'pro_title',
                    'value'=>function($data){
                        return '<a href="'.$this->createUrl('view',array('id'=>$data->pro_id)).'"><span>'.$data->pro_title.'</span></a><br><span>'.$data->pro_summary.'</span>';
                    },
                    'htmlOptions'=>array('width'=>'350'),
                ),
                array(
                    'name'=>'pro_images',
                    'filter'=>false,
                    'type'=>'raw',
                    'value'=>function($data){
                        return '<img width="100" src="'.YII::app()->baseUrl.'/uploads/'.$data->pro_images.'" />';
                    }
                ),
                array(
                    'type'=>'raw',
                    'name'=>'pro_cateidarr',
                    'value'=>function($data){
                        if($data->pro_cateidarr!="")
                        {
                            $cate = Categoriesp::model()->findByPk($data->pro_cateidarr);
                            return $cate->cate_title;
                        }
                        return "";
                    },
                    'htmlOptions'=>array('width'=>'130'),
                ),
                array(
                    'name'=>'pro_price',
                    'type'=>'raw',
                    'value'=>'"$".$data->pro_price',
                    'htmlOptions'=>array('width'=>'70','style'=>'text-align:right'),
                    'headerHtmlOptions'=>array('style'=>'text-align:right;'),
                ),
                array(
                    'name'=>'pro_discountprice',
                    'type'=>'raw',
                    'value'=>'"$".$data->pro_discountprice',
                    'htmlOptions'=>array('width'=>'70','style'=>'text-align:right'),
                    'headerHtmlOptions'=>array('style'=>'text-align:right;'),
                ),
                array(
                    'name'=>'pro_typical',
                    'filter'=>false,
                    'type'=>'raw',
                    'value'=>function($data){
                        if($data->pro_typical==0)
                            return '<a href="#" onclick="updateTypicalPro('.$data->pro_id.',1);return false;"><i class="icon-remove"></i></a>';
                        else
                            return '<a href="#" onclick="updateTypicalPro('.$data->pro_id.',0);return false;"><i class="icon-ok"></i></a>';
                    },
                    'htmlOptions'=>array('style'=>'text-align:center'),
                ),
                array(
                    'name'=>'pro_status',
                    'type'=>'raw',
                    'filter'=>false,
                    'value'=>function($data){
                        if($data->pro_status==0)
                            return '<a href="#" onclick="updateStatusPro('.$data->pro_id.',1);return false;"><i class="icon-remove"></i></a>';
                        else
                            return '<a href="#" onclick="updateStatusPro('.$data->pro_id.',0);return false;"><i class="icon-ok"></i></a>';
                    },
                    'htmlOptions'=>array('style'=>'text-align:center'),
                ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
                array(
                    'header'=>'<input type="checkbox" name="selectall" onclick="checkSelectAll()" id="selectall"/>',
                    'type'=>'raw',
                    'value'=>'\'<input type="checkbox" value="\'.$data->pro_id.\'" onclick="checkSelectCase()" name="case" class="case"/>\'',
                    'headerHtmlOptions'=>array(
                        'style'=>'width:40px; text-align:center;',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'text-align:center'
                    ),
                ), 
	),
)); ?>
<script type="text/javascript">
    function updateTypicalPro(pro_id,typical){
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('updateTypicalPro'); ?>',
            data:{pro_id:pro_id,typical:typical},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                    $.fn.yiiGridView.update('products-grid');
                else
                    alert("Error fail");
            }
        });
    }
    
    function updateStatusPro(pro_id,status){
        $.ajax({
            type:'POST',
            url:'<?php echo $this->createUrl('updateStatusPro'); ?>',
            data:{pro_id:pro_id,status:status},
            success:function(data){
                var obj = jQuery.parseJSON(data);
                if(obj.status=="success")
                    $.fn.yiiGridView.update('products-grid');
                else
                    alert("Error fail");
            }
        });
    }
</script>