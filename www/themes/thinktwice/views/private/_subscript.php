<?php
/* @var $form ActiveForm */
?>

<p><h5>Подписка: <h5>
        <?php $form=$this->beginWidget('ActiveForm', array(
            'id'=>'blog-form',
            'action'=>$this->createAbsoluteUrl('/private/subscript/'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of ActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

        <?php echo $form->errorSummary($subscript); ?>


        <div class="row">
            <?php echo $form->labelEx($subscript,'Тема'); ?>
            <?php echo $form->textField($subscript,'title',array('size'=>60,'maxlength'=>255));?>
            <?php echo $form->error($subscript,'title'); ?>
        </div>

        <div class="row">
            Стоимость:
            <select name='time'>
                <option value="month_price">За месяц</option>
                <option value="week_price">За неделю</option>
            </select>

           <input type='text' name='price' value='' />
        </div>

        <div class="row">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>

<?php $this->endWidget(); ?></p>