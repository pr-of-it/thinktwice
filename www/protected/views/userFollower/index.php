<?php
/* @var $this UserFollowerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Followers',
);

$this->menu=array(
	array('label'=>'Create UserFollower', 'url'=>array('create')),
	array('label'=>'Manage UserFollower', 'url'=>array('admin')),
);
?>

<h1>User Followers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
