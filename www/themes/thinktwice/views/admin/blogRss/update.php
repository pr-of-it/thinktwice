<?php
/* @var $this BlogRssController */
/* @var $model BlogRss */

$this->breadcrumbs=array(
	'Blog Rsses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BlogRss', 'url'=>array('index')),
	array('label'=>'Create BlogRss', 'url'=>array('create')),
	array('label'=>'View BlogRss', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BlogRss', 'url'=>array('admin')),
);
?>

<h1>Update BlogRss <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>