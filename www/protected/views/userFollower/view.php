<?php
/* @var $this UserFollowerController */
/* @var $model UserFollower */

$this->breadcrumbs=array(
	'User Followers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserFollower', 'url'=>array('index')),
	array('label'=>'Create UserFollower', 'url'=>array('create')),
	array('label'=>'Update UserFollower', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserFollower', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserFollower', 'url'=>array('admin')),
);
?>

<h1>View UserFollower #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'follower_id',
	),
)); ?>
