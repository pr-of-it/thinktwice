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

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login'); ?>
        <a class="alter-button" href="#"
            onlick="javascript:$('.register-block').show();$('.register-block').hide();return false;">
            Зарегистрироваться</a>
    </div>

    

    <?php $this->endWidget(); ?>
</div><!-- form -->