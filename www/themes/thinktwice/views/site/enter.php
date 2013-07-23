<?php
/* @var $this SiteController */
/* @var $registerForm RegisterForm */
/* @var $loginForm LoginForm */
/* @var $form ActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Присоединиться';
$this->breadcrumbs=array(
    'Присоединиться',
);
?>
<div class="form-block register-block" style="display: none">
    <h1>Вход на сайт</h1>

    <section>
        <h2>Зарегистрироваться на ThinkTwice</h2>
        <?php
        $this->renderPartial('_register', array(
            'model' => $registerForm,
        ));
        ?>

        <p class="note">Авторизуясь или регистрируясь, вы автоматически соглашаетесь
            с&nbsp;<a href="#">офертой пользователя</a></p>

        <?php if ($this->layout != 'expert-mobile'): ?>
            <?php Yii::app()->eauth->renderWidget(); ?>
        <?php endif; ?>
    </section>
</div>

<div class="form-block login-block">
    <h1>Вход на сайт</h1>

    <section>
    <?php
    $this->renderPartial('_login', array(
        'model' => $loginForm,
    ));
    ?>
    <p class="note">Авторизуясь или регистрируясь, вы автоматически соглашаетесь
            с&nbsp;<a href="#">офертой пользователя</a></p>
        <?php if ($this->layout != 'expert-mobile'): ?>
            <?php Yii::app()->eauth->renderWidget(); ?>
        <?php endif; ?>
    </section>
</div>
