<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $memberProfileModel MemberProfile */

$this->breadcrumbs=array(
	'Pr Members'=>array('index'),
	$model->pr_primary_key=>array('view','id'=>$model->pr_primary_key),
	'Update',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'View Members', 'url'=>array('view', 'id'=>$model->pr_primary_key)),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h1>Update Members <?php echo $model->pr_primary_key; ?></h1>

<?php $this->renderPartial('_form', array(
                                    'model'=>$model,
                                    'memberProfileModel'=>$memberProfileModel,
                            )); ?>