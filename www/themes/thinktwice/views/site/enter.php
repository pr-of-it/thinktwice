<?php
/* @var $this SiteController */
/* @var $registerForm RegisterForm */
/* @var $loginForm LoginForm */
/* @var $form ActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Присоединиться';
$this->breadcrumbs=array(
    'Присоединиться',
);
?>

<h1>Регистрация</h1>

<?php
$this->renderPartial('_register', array(
    'model' => $registerForm,
));
?>

<h1>Вход для зарегистрированных пользователей</h1>

<?php
$this->renderPartial('_login', array(
    'model' => $loginForm,
));
?>
