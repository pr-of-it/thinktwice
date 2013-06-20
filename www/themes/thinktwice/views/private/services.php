<?php
$this->pageTitle=Yii::app()->name . ' - Социальные сети';
$this->breadcrumbs=array(
    'Личный кабинет' => array('/private'),
    'Социальные сети',
);
?>

<?php if ( count($user->services) > 0 ) : ?>

    <h4>Ваши аккаунты в других сетях:</h4>
    <ul>
    <?php foreach ( $user->services as $service ): ?>
        <li><?php echo $service->service; ?> (<?php echo $service->service_user_name; ?>) <a href="<?php echo Yii::app()->createAbsoluteUrl('/private/deleteService', array('id'=>$service->id)) ; ?>">удалить привязку</a></li>
    <?php endforeach; ?>
    </ul>

<?php else : ?>
    <p>У Вас нет ни одного привязанного аккаунта в других сетях.</p>
<?php endif; ?>

<h4>Добавить аккаунт:</h4>
<?php Yii::app()->eauth->renderWidget(); ?>