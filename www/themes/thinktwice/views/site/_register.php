<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'register-form',
        'enableClientValidation'=>false,
    )); ?>

    <div class="row">
        <label for="RegisterForm_email" class="required">E-mail <span class="required">*</span></label>
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
            onclick="$('.register-block').hide();$('.login-block').show();return false;">
            Уже есть аккаунт</a>
    </div>

    <?php if ($this->layout != 'expert-mobile'): ?>
        <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'site/enter')); ?>
    <?php endif; ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->