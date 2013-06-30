<?php
/* @var $this PrivateController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php echo Yii::app()->easyImage->thumbOf($model->avatar, array('resize'=>array('width'=>150, 'height'=>150)));?>
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'profile-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'disabled' => 'disabled')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        +&nbsp;<?php echo $form->telField($model,'phone'); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

    <?php if ( $model->role->name == 'expert' ): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'can_consult'); ?>
        <?php echo $form->checkBox($model,'can_consult'); ?>
        <?php echo $form->error($model,'can_consult'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'consult_price'); ?>
        <?php echo $form->textField($model,'consult_price'); ?>
        <?php echo $form->error($model,'consult_price'); ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo CHtml::activeFileField($model, 'avatar'); ?>
        <?php echo CHtml::link('Удалить аватар', Yii::app()->createUrl('/private/deleteAvatar', array('id' => $model->id))); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить') ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->