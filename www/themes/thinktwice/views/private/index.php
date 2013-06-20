<?php
$this->pageTitle=Yii::app()->name . ' - Личный кабинет';
$this->breadcrumbs=array(
    'Личный кабинет',
);
?>


<p>Вы вошли как <?php echo $user->login; ?></p>
<p>Ваша роль <?php echo $user->role->name; ?></p>
<p>Ваш e-mail <?php echo $user->email; ?></p>
<?php if ( Yii::app()->user->service ) : ?>
    <p>Вы вошли через сервис <?php echo Yii::app()->user->service; ?></p>
    <p>Ваш ID в сервисе <?php echo Yii::app()->user->service_user_id; ?></p>
<?php endif; ?>

<h4>Ваши аккаунты в других сетях:</h4>
<ul>
<?php foreach ( $user->services as $service ): ?>
    <li><?php echo $service->service; ?> (<?php echo $service->service_user_name; ?>)</li>
<?php endforeach; ?>
</ul>
<p></p><a href="<?php echo Yii::app()->createAbsoluteUrl('/private/services') ; ?>">Добавить аккаунт</a></p>

<h4>Ваши followers:</h4>
<table>
    <?php foreach ($user->followers as $follower ): ?>
    <tr>
        <td><?php echo $follower->login; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h4>Ваш счет:</h4>
<p>Сумма на счету: <?php /*echo $user->amount;*/ ?></p>
<h6>Последние операции по счету:</h6>
