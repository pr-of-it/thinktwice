<?php
/* @var $this AdminController */
/* @var $model User */
?>

<?php
$this->breadcrumbs=array(
'Админпанель'
);
?>

<?php
$this->menu=array(
    array('label'=>'Пользователи', 'url'=>array('/admin/user')),
    array('label'=>'Инвайты', 'url'=>array('/admin/invite')),
    array('label'=>'Транзакции', 'url'=>array('/admin/userTransaction')),
    array('label'=>'Незавершенные транзакции', 'url'=>array('/admin/userTransactionIncomplete')),
    array('label'=>'Заявки на звонок', 'url'=>array('/admin/callRequest')),

);
?>

<h1>Админпанель</h1>

<p>тут мы будем выводить некую статистику по сайту</p>