<?php
/* @var $this UserAccountOperationController */
/* @var $model UserTransaction */

$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserTransaction', 'url'=>array('index')),
	array('label'=>'Create UserTransaction', 'url'=>array('create')),
	array('label'=>'View UserTransaction', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserTransaction', 'url'=>array('admin')),
);
?>

<h1>Update UserTransaction <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>