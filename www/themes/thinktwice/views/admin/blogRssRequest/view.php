<?php
/* @var $this BlogRssRequestController */
/* @var $model BlogRssRequest */

$this->breadcrumbs=array(
	'Blog Rss Requests'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BlogRssRequest', 'url'=>array('index')),
	array('label'=>'Create BlogRssRequest', 'url'=>array('create')),
	array('label'=>'Update BlogRssRequest', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BlogRssRequest', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BlogRssRequest', 'url'=>array('admin')),
);
?>

<h1>View BlogRssRequest #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'blog_id',
		'title',
		'url',
	),
)); ?>
