<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php if ($this->layout != 'expert-mobile'): ?>
        <h2>Либо Вы можете войти через следующие сервисы:</h2>
        <?php Yii::app()->eauth->renderWidget(); ?>
        <?php
        #$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
        ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->