<?php
/* @var $this PostController */
/* @var $model Post */

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->post_id,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->post_id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->post_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1>View Post #<?php echo $model->post_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'post_id',
		'post_title',
		'post_titleen',
		'post_summary',
		'post_summaryen',
		'post_content',
		'post_contenten',
		'post_image',
		'post_createdate',
		'post_memberid',
		'post_sublink',
		'post_typical',
		'post_status',
		'post_order',
	),
)); ?>
<div id="post_form_comment"></div>
<div id="post_view_comment"></div>
<script type="text/javascript">
    loadFormComment();
    loadViewComment();
    function loadFormComment(){
        //$('#post_coment').block();
        $('#post_form_comment').load('<?php echo $this->createUrl('/Comments/default/commentMember'); ?>',
        {entry:'<?php echo Post::ENTRY; ?>',entry_id:'<?php echo $model->post_id; ?>'});
    }
    function loadViewComment(){
        //$('#post_coment').block();
        $('#post_view_comment').load('<?php echo $this->createUrl('/Comments/default/viewListComment'); ?>',
            {entry:'<?php echo Post::ENTRY; ?>',entry_id:'<?php echo $model->post_id; ?>'});
    }
</script>