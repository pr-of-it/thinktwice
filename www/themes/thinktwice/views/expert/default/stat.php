<?php
/*
 * @var $this DefaultController
 * @var $user User
 * @var $form ActiveForm
 */

$this->breadcrumbs=array(
    'Интерфейс эксперта' => array('/expert'),
    'Статистика'
);
?>

<h1>Статистика</h1>
<div class="bg-gray b-shadow statistic">
    <div>Мой счет:<span><?php echo sprintf('%0.2f', $user->amount); ?>&nbsp;руб.</span></div>
    <div class="attendance">Посещаемость:<span> **10000 просмотров</span></div>
    <div>Совершенные консультации:<span> **135</span></div>
    <div>Рейтинг:<span><?php echo sprintf('%0.1f', $user->rating); ?></span></div>
</div>
