<?php
/* @var $this BlogController */
/* @var $model Blog */
/* @var $form ActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('ActiveForm', array(
	'id'=>'blog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of ActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'type'); ?>
        <?php echo $form->dropDownList($model, 'type', CHtml::listData( $model->getAllIdTypes(), 'id', 'type' )); ?>
        <?php echo $form->error($model,'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model, 'user_id', CHtml::listData( User::model()->findAll(), 'id', 'email' )); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'desc'); ?>
		<?php echo $form->textArea($model,'desc'); ?>
		<?php echo $form->error($model,'desc'); ?>
	</div>

    <div class="row">
        Стоимость:
        <select name='time'>
            <option value="month_price">За месяц</option>
            <option value="week_price">За неделю</option>
            <option value="year_price">За год</option>
        </select>

        <input type='text' name='price' value='' />
    </div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->