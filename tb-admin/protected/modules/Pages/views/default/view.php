<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	$model->page_id,
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
	array('label'=>'Update Pages', 'url'=>array('update', 'id'=>$model->page_id)),
	array('label'=>'Delete Pages', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->page_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pages', 'url'=>array('admin')),
);
?>
<h1><?php echo $model->page_title; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
        'type'=>'striped bordered condensed',
	'attributes'=>array(
		array(
                        'type'=>'raw',
                        'name'=>'page_content',
                    ),
		'page_tag',
                array(
                    'type'=>'raw',
                    'name'=>'page_createdate',
                    'value'=>function($data)
                                {
                                   return date(TBApplication::getFormatDate(),strtotime($data->page_createdate));     
                                }
                ),
                array(
                    'type'=>'raw',
                    'name'=>'page_status',
                    'value'=>function($data){
                        if($data->page_status==1)
                            return "Hiện";
                        else
                            return "Ẩn";
                    }
                )
	),
)); ?>
