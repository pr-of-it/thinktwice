<?php
/* @var $this TagCategoryController */
/* @var $model TagCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-category-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

    <div class="row">
		Parent:
        <?php $parent = $model->isNewRecord ? null : $model->parent()->find(); ?>
        <select name="parent">
            <?php foreach ( $model->getTree(true) as $cat ) : ?>
            <option
                value="<?php echo $cat->id; ?>"
                <?php if ( $parent && $cat->id == $parent->id ): ?> selected="selected"<?php endif; ?>
                <?php if ( 0 != $cat->id && $cat->id == $model->id ): ?> disabled="disabled"<?php endif; ?>
                >
                <?php echo str_repeat('-- ', $cat->level); ?><?php echo $cat->name; ?>
            </option>
            <?php endforeach; ?>
        </select>
	</div>

    <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->