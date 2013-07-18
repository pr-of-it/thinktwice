<?php
/* @var $user User */
/* @var $subscript Blog */
?>


<?php echo 'Вы собираетесь подключить подписку ' .
    $subscript->title . ' эксперта ' . $user->name . '. Стоимость подписки: ';
echo $subscript->month_price == 0 ? $subscript->week_price . 'руб/нед' : $subscript->month_price . 'руб/мес';?>

<div class="form">
    <?php $form = $this->beginWidget('ActiveForm', array(
        'id' => 'addSubscription-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton(
            'Подтвердить',
            array(
                'name' => 'yes')
        ); ?>
        <?php echo CHtml::submitButton(
            'Отменить',
            array(
                'name' => 'no')
        ); ?>
    </div>

       <?php $this->endWidget(); ?>
</div>