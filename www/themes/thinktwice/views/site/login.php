<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form ActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Вход на сайт',
);
?>

<h1>Вход на сайт</h1>

<?php
$this->renderPartial('_login', array(
    'model' => $model,
));
?>
