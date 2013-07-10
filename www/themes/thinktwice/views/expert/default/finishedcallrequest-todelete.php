<?php
$this->pageTitle=Yii::app()->name . ' - Заявка';
$this->breadcrumbs=array(
    'Все заявки'=>array('closest'),
    'Заявка №:' . $callRequest->id,
);

echo Yii::app()->user->getFlash('FAIL_WRITE');
?>

<p>Тема заявки: <?php echo $callRequest->title;?></p>
<p>Текст заявки: <?php echo $callRequest->text;?></p>
<p>Время консультации: <?php echo $callRequest->call_time;?></p>
<?php echo CHtml::link('Звонок состоялся', array(
    'default/updatestatus/',
    'id'=>$callRequest->id,
    'call_time'=>$callRequest->call_time,
    'status'=>CallRequest::STATUS_COMPLETE,
    'amountOff' => $amountOff,
)); ?>



