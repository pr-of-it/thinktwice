<?php
$this->pageTitle=Yii::app()->name . ' - Заявка';
$this->breadcrumbs=array(
    'Все заявки'=>array('index'),
    'Заявка №:' . $callRequest->id,
);

echo Yii::app()->user->getFlash('FAIL_WRITE');
?>
<p>Тема заявки: <?php echo $callRequest->title;?></p>
<p>Текст заявки: <?php echo $callRequest->text;?></p>
<p>Желаемое время истполнения заявки: <?php echo $callRequest->call_time;?></p>
<p>Альтернативное желаемое время истполнения заявки 1: <?php echo $callRequest->alter_call_time_1;?></p>
<p>Альтернативное желаемое время истполнения заявки 2: <?php echo $callRequest->alter_call_time_2;?></p>
<p>Примерная продолжительность консультации: <?php echo $callRequest->duration;?></p>
<p>Статус заявки: <?php echo $callRequest->statusDesc;?></p>
<?php echo CHtml::link('Подтвердить', array(
    'default/updatestatus/',
    'id'=>$callRequest->id,
    'status'=>CallRequest::STATUS_MODERATED,
)); ?>

<div class="form">

    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'status-form',
        'method'=>'post',
        'action'=>$this->createAbsoluteUrl('/operator/default/updatestatus/',array('id'=>$callRequest->id,
            'status'=>CallRequest::STATUS_REJECTED,)),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of ActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <?php echo $form->errorSummary($callRequest); ?>
    <div class="row">
        <?php echo $form->labelEx($callRequest,'Причина отклонения'); ?>
        <?php echo $form->textField($callRequest,'comments'); ?>
        <?php echo $form->error($callRequest,'comments'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Отклонить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

