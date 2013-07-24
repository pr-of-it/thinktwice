<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>false,
    )); ?>

    <div class="row">
        <label for="LoginForm_email" class="required">E-mail <span class="required">*</span></label>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row">
        <label for="LoginForm_password" class="required">Пароль <span class="required">*</span></label>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
        <p class="hint">
        </p>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Войти'); ?>
        <a class="alter-button" href="#"
            onclick="$('.login-block').hide();$('.register-block').show();return false;">
            Зарегистрироваться</a>
    </div>
    <?php if ($this->layout != 'expert-mobile'): ?>
        <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/enter')); ?>
    <?php endif; ?>
    

    <?php $this->endWidget(); ?>
</div><!-- form -->