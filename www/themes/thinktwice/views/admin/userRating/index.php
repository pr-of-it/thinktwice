<?php
/* @var $this UserRatingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Ratings',
);

$this->menu=array(
	array('label'=>'Create UserRating', 'url'=>array('create')),
	array('label'=>'Manage UserRating', 'url'=>array('admin')),
);
?>

<h1>User Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
