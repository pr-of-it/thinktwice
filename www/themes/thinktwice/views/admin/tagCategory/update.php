<?php
/* @var $this TagCategoryController */
/* @var $model TagCategory */

$this->breadcrumbs=array(
	'Tag Categories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TagCategory', 'url'=>array('index')),
	array('label'=>'Create TagCategory', 'url'=>array('create')),
	array('label'=>'View TagCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TagCategory', 'url'=>array('admin')),
);
?>

<h1>Update TagCategory <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>