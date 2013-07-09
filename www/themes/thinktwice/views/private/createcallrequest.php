<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
    'id'=>'callrequest-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of ActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<h1>Форма заказа консультации</h1>
    <?php echo Yii::app()->user->getFlash("FORM_REQUEST"); ?>
<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'Тема'); ?>
    <?php echo $form->textField($model,'title',array('size'=>40,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Вопрос'); ?>
    <?php echo $form->textField($model,'text',array('size'=>40,'maxlength'=>255)); ?>
    <?php echo $form->error($model,'text'); ?>
</div>


<div class="row">
    <?php echo $form->labelEx($model,'Желаемое время звонка'); ?>
    <?php echo $form->textField($model,'call_time'); ?>
    <?php echo $form->error($model,'call_time'); ?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'Альтернативное желаемое время 1'); ?>
    <?php echo $form->textField($model,'alter_call_time_1'); ?>
    <?php echo $form->error($model,'alter_call_time_1'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Альтернативное желаемое время 2'); ?>
    <?php echo $form->textField($model,'alter_call_time_2'); ?>
    <?php echo $form->error($model,'alter_call_time_2'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'Примерная продолжительность в минутах'); ?>
    <?php echo $form->textField($model,'duration'); ?>
    <?php echo $form->error($model,'duration'); ?>
</div>

    <?php echo $form->hiddenField($expert,'consult_price')?>

    <?php echo $Summ; ?>

<div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Отправить' : 'Save', array(
        'onclick' => 'return calculateCallRequest()'
    )); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    function calculateCallRequest() {
        var price = $('#User_consult_price').val();
        var duration = $('#CallRequest_duration').val();
        if ( duration == 0 )
            return false;
        return confirm('Стоимость консультации составит '+ price*duration + ' рублей. Подтверждаете заказ?');
    }
</script>
