<?php
/* @var $this PrivateController */
/* @var $model RegisterForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Смена пароля';
$this->breadcrumbs=array(
    'Личный кабинет' => array('/private'),
    'Смена пароля',
);
?>

<h1>Смена пароля</h1>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'register-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'oldPassword'); ?>
        <?php echo $form->passwordField($model,'oldPassword'); ?>
        <?php echo $form->error($model,'oldPassword'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'newPassword'); ?>
        <?php echo $form->passwordField($model,'newPassword'); ?>
        <?php echo $form->error($model,'newPassword'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'newPasswordRepeat'); ?>
        <?php echo $form->passwordField($model,'newPasswordRepeat'); ?>
        <?php echo $form->error($model,'newPasswordRepeat'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сменить пароль'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
