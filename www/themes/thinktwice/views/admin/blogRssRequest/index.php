<?php
/* @var $this BlogRssRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blog Rss Requests',
);

$this->menu=array(
	array('label'=>'Create BlogRssRequest', 'url'=>array('create')),
	array('label'=>'Manage BlogRssRequest', 'url'=>array('admin')),
);
?>

<h1>Blog Rss Requests</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
