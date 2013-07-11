<?php
/* @var $this CallRequestController */
/* @var $model CallRequest */
/* @var $form ActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'call-request-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of ActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model,'user_id', CHtml::listData( User::model()->findAll(), 'id', 'email' )); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'caller_id'); ?>
        <?php echo $form->dropDownList($model,'caller_id', CHtml::listData( User::model()->findAll(), 'id', 'email' )); ?>
        <?php echo $form->error($model,'caller_id'); ?>
    </div>


    <div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>


    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', CHtml::listData( CallRequest::model()->getStatusList(), 'id', 'value' )); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'call_time'); ?>
		<?php echo $form->textField($model,'call_time'); ?>
		<?php echo $form->error($model,'call_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alter_call_time_1'); ?>
		<?php echo $form->textField($model,'alter_call_time_1'); ?>
		<?php echo $form->error($model,'alter_call_time_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alter_call_time_2'); ?>
		<?php echo $form->textField($model,'alter_call_time_2'); ?>
		<?php echo $form->error($model,'alter_call_time_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
		<?php echo $form->error($model,'duration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'comments'); ?>
		<?php echo $form->textField($model, 'comments_json');  ?>
		<?php echo $form->error($model,'comments_json'); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
