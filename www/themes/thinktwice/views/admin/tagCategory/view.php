<?php
/* @var $this TagCategoryController */
/* @var $model TagCategory */

$this->breadcrumbs=array(
	'Tag Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TagCategory', 'url'=>array('index')),
	array('label'=>'Create TagCategory', 'url'=>array('create')),
	array('label'=>'Update TagCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TagCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TagCategory', 'url'=>array('admin')),
);
?>

<h1>View TagCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'category',
		'left',
		'right',
		'level',
	),
)); ?>
