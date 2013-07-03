<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form ActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Register';
$this->breadcrumbs=array(
	'Регистрация на сайте',
);
?>

<h1>Регистрация</h1>

<?php
$this->renderPartial('_register', array(
    'model' => $model,
));
?>