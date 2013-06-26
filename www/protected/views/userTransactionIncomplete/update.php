<?php
/* @var $this UserTransactionIncompleteController */
/* @var $model UserTransactionIncomplete */

$this->breadcrumbs=array(
	'User Transaction Incompletes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserTransactionIncomplete', 'url'=>array('index')),
	array('label'=>'Create UserTransactionIncomplete', 'url'=>array('create')),
	array('label'=>'View UserTransactionIncomplete', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserTransactionIncomplete', 'url'=>array('admin')),
);
?>

<h1>Update UserTransactionIncomplete <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>