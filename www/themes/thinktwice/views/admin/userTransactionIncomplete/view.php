<?php
/* @var $this UserTransactionIncompleteController */
/* @var $model UserTransactionIncomplete */

$this->breadcrumbs=array(
	'User Transaction Incompletes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserTransactionIncomplete', 'url'=>array('index')),
	array('label'=>'Create UserTransactionIncomplete', 'url'=>array('create')),
	array('label'=>'Update UserTransactionIncomplete', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserTransactionIncomplete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserTransactionIncomplete', 'url'=>array('admin')),
);
?>

<h1>View UserTransactionIncomplete #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'amount',
		'reason',
		'time',
	),
)); ?>
