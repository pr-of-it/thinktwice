<?php
/* @var $this UserAccountOperationController */
/* @var $model UserAccountOperation */

$this->breadcrumbs=array(
	'User Account Operations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserAccountOperation', 'url'=>array('index')),
	array('label'=>'Manage UserAccountOperation', 'url'=>array('admin')),
);
?>

<h1>Create UserAccountOperation</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>