<?php
/* @var $this BlogRssController */
/* @var $model BlogRss */

$this->breadcrumbs=array(
	'Blog Rsses'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List BlogRss', 'url'=>array('index')),
	array('label'=>'Create BlogRss', 'url'=>array('create')),
	array('label'=>'Update BlogRss', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BlogRss', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BlogRss', 'url'=>array('admin')),
);
?>

<h1>View BlogRss #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'blog_id',
		'title',
		'url',
        'active',
	),
)); ?>
