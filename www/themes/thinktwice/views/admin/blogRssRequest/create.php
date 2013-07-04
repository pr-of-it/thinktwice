<?php
/* @var $this BlogRssRequestController */
/* @var $model BlogRssRequest */

$this->breadcrumbs=array(
	'Blog Rss Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BlogRssRequest', 'url'=>array('index')),
	array('label'=>'Manage BlogRssRequest', 'url'=>array('admin')),
);
?>

<h1>Create BlogRssRequest</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>