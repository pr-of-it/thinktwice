<?php
/* @var $this TagCategoryController */
/* @var $model TagCategory */

$this->breadcrumbs=array(
	'Tag Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TagCategory', 'url'=>array('index')),
	array('label'=>'Manage TagCategory', 'url'=>array('admin')),
);
?>

<h1>Create TagCategory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>