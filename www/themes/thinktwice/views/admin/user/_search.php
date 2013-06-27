<?php
/* @var $this UserController */
/* @var $model User */
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
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'phone'); ?>
        <?php echo $form->textField($model,'phone'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'active'); ?>
        <?php echo $form->checkBox($model,'phone'); ?>
    </div>

    <div class="row">
		<?php echo $form->label($model,'register_time'); ?>
		<?php echo $form->textField($model,'register_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'update_time'); ?>
		<?php echo $form->textField($model,'update_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'can_consult'); ?>
        <?php echo $form->checkBox($model,'can_consult'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'consult_price'); ?>
        <?php echo $form->textField($model,'consult_price'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->