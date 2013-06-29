<?php
$this->pageTitle=Yii::app()->name . ' - Заявка';
$this->breadcrumbs=array(
    'Все заявки'=>array('index'),
    'Заявка №:' . $callRequest->id,
);?>
<p>Тема заявки: <?php echo $callRequest->title;?></p>
<p>Текст заявки: <?php echo $callRequest->text;?></p>
<p>Желаемое время истполнения заявки: <?php echo $callRequest->call_time;?></p>
<p>Альтернативное желаемое время истполнения заявки 1: <?php echo $callRequest->alter_call_time_1;?></p>
<p>Альтернативное желаемое время истполнения заявки 2: <?php echo $callRequest->alter_call_time_2;?></p>
<p>Примерная продолжительность консультации: <?php echo $callRequest->duration;?></p>
