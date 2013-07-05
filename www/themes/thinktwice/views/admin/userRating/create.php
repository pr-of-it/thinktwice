<?php
/* @var $this UserRatingController */
/* @var $model UserRating */

$this->breadcrumbs=array(
	'User Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserRating', 'url'=>array('index')),
	array('label'=>'Manage UserRating', 'url'=>array('admin')),
);
?>

<h1>Create UserRating</h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'user'=>$user)); ?>