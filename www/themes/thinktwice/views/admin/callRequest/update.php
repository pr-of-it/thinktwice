<?php
/* @var $this CallRequestController */
/* @var $model CallRequest */

$this->breadcrumbs=array(
	'Call Requests'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CallRequest', 'url'=>array('index')),
	array('label'=>'Create CallRequest', 'url'=>array('create')),
	array('label'=>'View CallRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CallRequest', 'url'=>array('admin')),
);
?>

<h1>Update CallRequest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>