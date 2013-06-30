<?php
/* @var $this BlogRssController */
/* @var $model BlogRss */

$this->breadcrumbs=array(
	'Blog Rsses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BlogRss', 'url'=>array('index')),
	array('label'=>'Manage BlogRss', 'url'=>array('admin')),
);
?>

<h1>Create BlogRss</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>