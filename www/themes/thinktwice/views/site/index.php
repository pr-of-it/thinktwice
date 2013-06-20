<h1>Будущая главная страница</h1>
<?php if ( !Yii::app()->user->isGuest ) : ?>
    <p>Вы вошли как <?php echo Yii::app()->user->login; ?></p>
    <p>Ваш e-mail <?php echo Yii::app()->user->email; ?></p>
    <p>Вы вошли через сервис <?php echo Yii::app()->user->service; ?></p>
    <p>Ваш ID в сервисе <?php echo Yii::app()->user->service_user_id; ?></p>
<?php endif; ?>