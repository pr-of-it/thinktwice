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

