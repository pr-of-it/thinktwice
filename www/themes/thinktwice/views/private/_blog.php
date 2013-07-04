<p><h5>Блог: <h5>
        <?php ?>
        <?php $form=$this->beginWidget('ActiveForm', array(
            'id'=>'blog-form',
            'action'=>$this->createAbsoluteUrl('/privateblog/blog/'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of ActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

        <?php echo $form->errorSummary($user->blog); ?>


        <div class="row">
            <?php echo $form->textField($user->blog,'title',array('size'=>60,'maxlength'=>255));?>
            <?php echo $form->error($user->blog,'title'); ?>
        </div>

        <div class="row">
            <?php echo CHtml::submitButton('Сохранить'); ?>
        </div>

<?php $this->endWidget(); ?></p>