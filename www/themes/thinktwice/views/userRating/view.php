<?php
/* @var $this UserRatingController */
/* @var $model UserRating */

$this->breadcrumbs=array(
	'User Ratings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserRating', 'url'=>array('index')),
	array('label'=>'Create UserRating', 'url'=>array('create')),
	array('label'=>'Update UserRating', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserRating', 'url'=>array('admin')),
);
?>

<h1>View UserRating #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'rater_id',
		'rate',
		'date',
	),
)); ?>
