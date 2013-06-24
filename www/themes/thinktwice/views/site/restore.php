<?php
/* @var $this SiteController */
/* @var $model RegisterForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Password restore';
$this->breadcrumbs=array(
    'Password restore',
);
?>

<h1>Восстановление пароля</h1>

<?php if ($success) : ?>
Письмо с новым паролем отправлено Вам на указанный адрес.
<?php else : ?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'restore-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Restore'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<?php endif; ?>