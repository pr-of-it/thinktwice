<?php
/* @var $this BlogRssController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Blog Rsses',
);

$this->menu=array(
	array('label'=>'Create BlogRss', 'url'=>array('create')),
	array('label'=>'Manage BlogRss', 'url'=>array('admin')),
);
?>

<h1>Blog Rsses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
