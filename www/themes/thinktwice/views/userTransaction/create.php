<?php
/* @var $this UserAccountOperationController */
/* @var $model UserTransaction */

$this->breadcrumbs=array(
	'User Transactions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserTransaction', 'url'=>array('index')),
	array('label'=>'Manage UserTransaction', 'url'=>array('admin')),
);
?>

<h1>Create UserTransaction</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>