<?php
/* @var $this UserAccountOperationController */
/* @var $model UserAccountOperation */

$this->breadcrumbs=array(
	'User Account Operations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserAccountOperation', 'url'=>array('index')),
	array('label'=>'Create UserAccountOperation', 'url'=>array('create')),
	array('label'=>'View UserAccountOperation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserAccountOperation', 'url'=>array('admin')),
);
?>

<h1>Update UserAccountOperation <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>