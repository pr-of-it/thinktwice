<?php
/* @var $this UserAccountOperationController */
/* @var $model UserTransaction */

$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserTransaction', 'url'=>array('index')),
	array('label'=>'Create UserTransaction', 'url'=>array('create')),
	array('label'=>'Update UserTransaction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserTransaction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserTransaction', 'url'=>array('admin')),
);
?>

<h1>View UserTransaction #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'amount',
                'amount_before',
                'amount_after',
		'reason',
		'time',
	),
)); ?>
