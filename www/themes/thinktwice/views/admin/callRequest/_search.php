<?php
/* @var $this CallRequestController */
/* @var $model CallRequest */
/* @var $form ActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caller_id'); ?>
		<?php echo $form->textField($model,'caller_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'call_time'); ?>
		<?php echo $form->textField($model,'call_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alter_call_time_1'); ?>
		<?php echo $form->textField($model,'alter_call_time_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alter_call_time_2'); ?>
		<?php echo $form->textField($model,'alter_call_time_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duration'); ?>
		<?php echo $form->textField($model,'duration'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->