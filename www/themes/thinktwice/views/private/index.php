<?php
$this->pageTitle=Yii::app()->name . ' - Личный кабинет';
$this->breadcrumbs=array(
    'Личный кабинет',
);
?>

<p>Ваша роль <?php echo $user->role->name; ?></p>
<p>Ваш e-mail <?php echo $user->email; ?></p>
<?php if ( Yii::app()->user->service ) : ?>
    <p>Вы вошли через сервис <?php echo Yii::app()->user->service; ?></p>
    <p>Ваш ID в сервисе <?php echo Yii::app()->user->service_user_id; ?></p>
<?php endif; ?>

<p></p><a href="<?php echo Yii::app()->createAbsoluteUrl('/private/password') ; ?>">Сменить пароль</a></p>


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
<p>Сумма на счету: <?php echo sprintf("%01.2f", $user->getAmount()); ?></p>

<h6>Последние операции по счету:</h6>
<table>
    <thead>
        <tr><td>№</td><td>Дата</td><td>Сумма до операции</td><td>Приход</td><td>Расход</td><td>Тип операции</td><td>Остаток</td></tr>
    </thead>
    <?php foreach (array_slice($user->transactions,-10,10) as $transaction ): ?>

    <tr>
        <td><?php echo $transaction->id; ?></td>
        <td><?php echo strstr($transaction->time,'.',true); ?></td>
        <td><?php echo sprintf("%01.2f", $transaction->amount_before); ?></td>

        <td><?php
        $formatted = sprintf("%01.2f", $transaction->amount);
        if($formatted >0){
            echo $formatted;
        }?></td>
        <td><?php if($formatted <0){
            echo $formatted;
        }?></td>
        <td><?php echo $transaction->reason; ?></td>
        <td><?php echo sprintf("%01.2f", $transaction->amount_after) ?></td>
    </tr>

    <?php endforeach; ?>
</table>
<a href="<?php echo Yii::app()->createAbsoluteUrl('/private/deposit') ; ?>">Пополнить счет</a></p>
<a href="<?php echo Yii::app()->createAbsoluteUrl('/private/account') ; ?>">Полный список операций</a></p>


