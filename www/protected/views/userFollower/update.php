<?php
/* @var $this UserFollowerController */
/* @var $model UserFollower */

$this->breadcrumbs=array(
	'User Followers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserFollower', 'url'=>array('index')),
	array('label'=>'Create UserFollower', 'url'=>array('create')),
	array('label'=>'View UserFollower', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserFollower', 'url'=>array('admin')),
);
?>

<h1>Update UserFollower <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>