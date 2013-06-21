<?php
/* @var $this UserAccountOperationController */
/* @var $model UserAccountOperation */

$this->breadcrumbs=array(
	'User Account Operations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UserAccountOperation', 'url'=>array('index')),
	array('label'=>'Create UserAccountOperation', 'url'=>array('create')),
	array('label'=>'Update UserAccountOperation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UserAccountOperation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UserAccountOperation', 'url'=>array('admin')),
);
?>

<h1>View UserAccountOperation #<?php echo $model->id; ?></h1>

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
