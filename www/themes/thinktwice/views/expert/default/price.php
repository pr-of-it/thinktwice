<?php
/*
 * @var $this DefaultController
 * @var $user User
 * @var $form CActiveForm
 */

$user->consult_price = floatval($user->consult_price);

$this->breadcrumbs=array(
    $this->module->id,
);
?>

<h1>Стоимость консультаций</h1>
<div class="bg-gray b-shadow price">

    <div>Текущая стоимость:<span> <?php echo sprintf('%0.2f', $user->consult_price); ?>&nbsp;руб./мин.</span></div>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'price-form',
        'method'=>'post',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <?php echo $form->errorSummary($user); ?>

    <label><?php echo $form->labelEx($user,'Изменить цену минуты:'); ?></label>
    <div class="clearfix">
        <div style="width:100%;"><?php echo $form->textField($user,'consult_price'); ?></div><span>руб./мин.</span>
        <div style="width:100%;"><?php echo $form->error($user,'consult_price'); ?></div>
    </div>
    <div class="table"><?php echo CHtml::submitButton('Сохранить', array('class' => 'but but-yellow')); ?></div>

    <?php $this->endWidget(); ?>

</div>