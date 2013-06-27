<?php
/* @var $this CallRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Call Requests',
);

$this->menu=array(
	array('label'=>'Create CallRequest', 'url'=>array('create')),
	array('label'=>'Manage CallRequest', 'url'=>array('admin')),
);
?>

<h1>Call Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
