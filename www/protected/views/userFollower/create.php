<?php
/* @var $this UserFollowerController */
/* @var $model UserFollower */

$this->breadcrumbs=array(
	'User Followers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserFollower', 'url'=>array('index')),
	array('label'=>'Manage UserFollower', 'url'=>array('admin')),
);
?>

<h1>Create UserFollower</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>