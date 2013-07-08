<?php
$this->pageTitle=Yii::app()->name . ' - Заявка';
$this->breadcrumbs=array(
    'Все заявки'=>array('requests'),
    'Заявка №:' . $callRequest->id,
);

echo Yii::app()->user->getFlash('FAIL_WRITE');
?>

    <p>Тема заявки: <?php echo $callRequest->title;?></p>
    <p>Текст заявки: <?php echo $callRequest->text;?></p>
    <p>Время консультации: <?php echo $callRequest->call_time;?></p>
    <p>Альтернативное время консультации: </p>

    <p><?php if ( $callRequest->alter_call_time_1 != $callRequest->call_time  ) {
        echo $callRequest->alter_call_time_1;?>
        <?php echo CHtml::link('Перенести на ' . $callRequest->alter_call_time_1, array(
            'default/updateStatus/',
            'id'=>$callRequest->id,
            'call_time'=>$callRequest->alter_call_time_1,
            'status'=>null,));
        }
        ?>
    </p>
    <p> <?php if ( $callRequest->alter_call_time_2 != $callRequest->call_time  ) {
        echo $callRequest->alter_call_time_2;?>
        <?php echo CHtml::link('Перенести на ' . $callRequest->alter_call_time_2, array(
            'default/updateStatus/',
            'id'=>$callRequest->id,
            'call_time'=>$callRequest->alter_call_time_2,
            'status'=>null,));
        }
        ?>
    </p>
    <p>Примерная продолжительность консультации: <?php echo $callRequest->duration;?></p>
    <p>Статус заявки: <?php echo $callRequest->statusDesc;?></p>

    <?php echo CHtml::link('Подтвердить', array(
        'default/updatestatus/',
        'id'=>$callRequest->id,
        'call_time'=>$callRequest->call_time,
        'status'=>CallRequest::STATUS_ACCEPTED,
    )); ?>

<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'status-form',
        'method'=>'post',
        'action'=>$this->createAbsoluteUrl('/expert/default/updatestatus/',array('id'=>$callRequest->id,
            'status'=>CallRequest::STATUS_REJECTED)),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of ActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <?php echo $form->errorSummary($callRequest); ?>

    <input type='text' name='comments' value='' />

    <div class="row buttons">
        <?php echo CHtml::submitButton('Отклонить'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->

