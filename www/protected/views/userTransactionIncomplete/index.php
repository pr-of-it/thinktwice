<?php
/* @var $this UserTransactionIncompleteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Transaction Incompletes',
);

$this->menu=array(
	array('label'=>'Create UserTransactionIncomplete', 'url'=>array('create')),
	array('label'=>'Manage UserTransactionIncomplete', 'url'=>array('admin')),
);
?>

<h1>User Transaction Incompletes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
