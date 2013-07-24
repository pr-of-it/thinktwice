<?php
/* @var $this TagCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Categories',
);

$this->menu=array(
	array('label'=>'Create TagCategory', 'url'=>array('create')),
	array('label'=>'Manage TagCategory', 'url'=>array('admin')),
);
?>

<h1>Tag Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
