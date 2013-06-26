<?php
/* @var $this UserAccountOperationController */
/* @var $model UserTransaction */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
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
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount',array('size'=>19,'maxlength'=>19)); ?>
	</div>
        <div class="row">
		<?php echo $form->label($model,'amount_before'); ?>
		<?php echo $form->textField($model,'amount_before',array('size'=>19,'maxlength'=>19)); ?>
	</div>
         <div class="row">
		<?php echo $form->label($model,'amount_after'); ?>
		<?php echo $form->textField($model,'amount_after',array('size'=>19,'maxlength'=>19)); ?>
	</div>
	<div class="row">
		<?php echo $form->label($model,'reason'); ?>
		<?php echo $form->textField($model,'reason',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->