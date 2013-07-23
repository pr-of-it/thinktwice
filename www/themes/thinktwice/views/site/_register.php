<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'register-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat'); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'invite_code'); ?>
        <?php echo $form->textField($model,'invite_code'); ?>
        <?php echo $form->error($model,'invite_code'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Зарегистрироваться'); ?>
        <a class="alter-button" href="#"
            onlick="javascript:$('.register-block').hide();$('.register-block').show();return false;">
            Уже есть аккаунт</a>
    </div>

    <?php if ($this->layout != 'expert-mobile'): ?>
        <h2>Либо Вы можете зарегистрироваться через следующие сервисы:</h2>
        <?php Yii::app()->eauth->renderWidget(); ?>
        <?php
        #$this->widget('ext.eauth.EAuthWidget', array('action' => 'site/login'));
        ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->