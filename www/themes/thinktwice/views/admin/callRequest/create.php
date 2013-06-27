<?php
/* @var $this CallRequestController */
/* @var $model CallRequest */

$this->breadcrumbs=array(
	'Call Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CallRequest', 'url'=>array('index')),
	array('label'=>'Manage CallRequest', 'url'=>array('admin')),
);
?>

<h1>Create CallRequest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>