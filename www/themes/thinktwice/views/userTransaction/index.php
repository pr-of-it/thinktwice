<?php
/* @var $this UserAccountOperationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Transactions',
);

$this->menu=array(
	array('label'=>'Create UserTransaction', 'url'=>array('create')),
	array('label'=>'Manage UserTransaction', 'url'=>array('admin')),
);
?>

<h1>User Transactions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
