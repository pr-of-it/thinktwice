<?php

/* @var $this PrivateController */
/* @var $model DepositForm */
/* @var $form ActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Пополнение счета';
$this->breadcrumbs=array(
    'Личный кабинет' => array('/private'),
    'Пополнение счета',
);
?>

<h1>Пополнение счета</h1>
<?php echo Yii::app()->user->getFlash("NO_AMOUNT"); ?>
<?php if ( null === $model->acqObject ) : ?>

<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'deposit-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'amount'); ?>
        <?php echo $form->textField($model,'amount'); ?>
        <?php echo $form->error($model,'amount'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'acquiring'); ?>
        <?php echo $form->dropDownList($model,'acquiring', $model->acquirings); ?>
        <?php echo $form->error($model,'acquiring'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Пополнить счет'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<?php else : ?>
    <?php $this->widget($model->acqObject->getSubformWidget(), array('acquiring' => $model->acqObject)); ?>
<?php endif; ?>