<?php
/* @var $this UserTransactionIncompleteController */
/* @var $model UserTransactionIncomplete */

$this->breadcrumbs=array(
	'User Transaction Incompletes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserTransactionIncomplete', 'url'=>array('index')),
	array('label'=>'Manage UserTransactionIncomplete', 'url'=>array('admin')),
);
?>

<h1>Create UserTransactionIncomplete</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>