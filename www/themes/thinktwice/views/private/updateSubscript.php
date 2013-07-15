<?php
$this->pageTitle=Yii::app()->name . ' - Изменить подписку';
$this->breadcrumbs=array(
    'Личный кабинет' => array('/private'),
    'Изменить подписку',
);
?>
<?php $this->renderPartial('_subscript', array('subscript'=>$subscript)); ?>