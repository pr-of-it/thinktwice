<?php
/* @var $this BlogRssRequestController */
/* @var $model BlogRssRequest */

$this->breadcrumbs=array(
	'Blog Rss Requests'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BlogRssRequest', 'url'=>array('index')),
	array('label'=>'Create BlogRssRequest', 'url'=>array('create')),
	array('label'=>'View BlogRssRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BlogRssRequest', 'url'=>array('admin')),
);
?>

<h1>Update BlogRssRequest <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>