<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'user-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <?php if ($model->isNewRecord): ?>
    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
    <?php endif; ?>

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

    <div class="row">
        <?php echo $form->labelEx($model,'active'); ?>
        <?php echo $form->checkBox($model,'active'); ?>
        <?php echo $form->error($model,'active'); ?>
    </div>

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

    <div class="row">
        <?php echo $form->labelEx($model,'role'); ?>
        <?php echo $form->dropDownList($model,'roleid', CHtml::listData( UserRole::model()->findAll(), 'id', 'name' )); ?>
        <?php echo $form->error($model,'roleid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'avatar'); ?>
        <?php echo CHtml::activeFileField($model, 'avatar'); ?>
        <?php echo $form->error($model,'avatar'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->