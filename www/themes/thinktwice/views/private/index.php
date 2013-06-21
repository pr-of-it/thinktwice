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
<p>Сумма на счету: 
    <?php
        $summ = 0;
        foreach($user->operations as $operations ){
            $summ +=$operations->amount;
        }
        echo $summ;
    ?>
</p>
<h6>Последние операции по счету:</h6>
<table>
    <thead>
        <tr><td>№</td><td>Дата</td><td>Сумма до операции</td><td>Приход</td><td>Расход</td><td>Тип операции</td><td>Сумма после операции</td></tr>
    </thead>
    <?php foreach ($user->operations as $operations ): ?>
    <tr>
        <td><?php echo $operations->id; ?></td>
        <td><?php echo $operations->time; ?></td>
        <td><?php echo $reas = sprintf("%01.2f", $operations->amount_before); ?></td>
       
        <td><?php
        $formatted = sprintf("%01.2f", $operations->amount);        
        if($formatted >0){
            echo $formatted;
        }?></td>
        <td><?php if($formatted <0){
            echo $formatted;
        }?></td>
        <td><?php echo $operations->reason; ?></td>
        <td><?php echo $reas = sprintf("%01.2f", $operations->amount_after) ?></td>
        <td><?php //остаток ?></td>
    </tr>
    <?php endforeach; ?>
</table>
