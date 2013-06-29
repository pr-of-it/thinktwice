<?php
/* @var $this PrivateController */
/* @var $user User */

$this->pageTitle=Yii::app()->name . ' - Профиль';
$this->breadcrumbs=array(
    'Личный кабинет' => array('/private'),
    'Профиль',
);
?>

<h1>Редактирование профиля</h1>

<?php $this->renderPartial('_form', array('model'=>$user)); ?>

