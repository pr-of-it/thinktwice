<?php
/* @var $this InviteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invites',
);

$this->menu=array(
	array('label'=>'Create Invite', 'url'=>array('create')),
	array('label'=>'Manage Invite', 'url'=>array('admin')),
);
?>

<h1>Invites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
