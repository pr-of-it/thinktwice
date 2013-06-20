<?php
/* @var $this UserAccountOperationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Account Operations',
);

$this->menu=array(
	array('label'=>'Create UserAccountOperation', 'url'=>array('create')),
	array('label'=>'Manage UserAccountOperation', 'url'=>array('admin')),
);
?>

<h1>User Account Operations</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
