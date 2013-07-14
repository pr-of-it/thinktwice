<?php
/* @var $this CallRequestController */
/* @var $model CallRequest */

$this->breadcrumbs=array(
	'Call Requests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List CallRequest', 'url'=>array('index')),
	array('label'=>'Create CallRequest', 'url'=>array('create')),
	array('label'=>'Update CallRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CallRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CallRequest', 'url'=>array('admin')),
);
?>

<h1>View CallRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'caller_id',
		'title',
		'text',
		'status',
		'call_time',
		'alter_call_time_1',
		'alter_call_time_2',
		'duration',
//		'comments',
	),
)); ?>
