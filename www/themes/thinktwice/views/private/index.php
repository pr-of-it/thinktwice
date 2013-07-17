<?php
$this->pageTitle=Yii::app()->name . ' - Личный кабинет';
$this->breadcrumbs=array(
    'Личный кабинет',
);
?>
<table>
    <tr>
        <td><?php

            $form=$this->beginWidget('ActiveForm', array(
                'id'=>'profile-form',
                'action'=>$this->createAbsoluteUrl('/private/profile/'),
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of ActiveForm for details on this.
                'enableAjaxValidation'=>false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
            ?>

            <?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>108, 'height'=>108)));?>

            <?php if ( !$user->hasAvatar() ): ?>
            <div class="row">
                <?php echo CHtml::activeFileField($user, 'avatar_file'); ?>
                <?php echo $form->error($user,'avatar_file'); ?>
            </div>
            <div class="row">
                <?php echo CHtml::submitButton('Сохранить'); ?>
            </div>

               <?php endif; ?>

             <?php $this->endWidget(); ?>
        </td>
        <td><p>Ваша роль <?php echo $user->role->name; ?></p>
            <p>Ваш e-mail <?php echo $user->email; ?></p>
            <?php if ( Yii::app()->user->service ) : ?>
                <p>Вы вошли через сервис <?php echo Yii::app()->user->service; ?></p>
                <p>Ваш ID в сервисе <?php echo Yii::app()->user->service_user_id; ?></p>
            <?php endif; ?>

            <p></p><a href="<?php echo Yii::app()->createAbsoluteUrl('/private/password') ; ?>">Сменить пароль</a></p>
            <p></p><a href="<?php echo Yii::app()->createAbsoluteUrl('/private/profile') ; ?>">Редактировать профиль</a></p>
        </td>
    </tr>
</table>
<h4>Ваши аккаунты в других сетях:</h4>
<ul>
    <?php foreach ( $user->services as $service ): ?>
        <li><?php echo $service->service; ?> (<?php echo $service->service_user_name; ?>)</li>
    <?php endforeach; ?>
</ul>
<p></p><a href="<?php echo Yii::app()->createAbsoluteUrl('/private/services') ; ?>">Добавить аккаунт</a></p>

<!-- Форма Блога -->

<?php
    $this->renderPartial('_blog', array('user'=>$user));
?>
<!--Форма вывода и добавления ленты RSS для пользователя - RSS -->
<?php if ( $user->role->name == 'rss' ) :;?>

    <?php $this->renderPartial('_rss', array('user' => $user, 'rss' => $rss)); ?>

    <p> <h5>Список rss лент:</h5>
        <?php
        $dataProvider = new CActiveDataProvider($user->model());
        $dataProvider->setData($user->blog->rss);
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'rss-grid',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                'title',
                'url',
            ),
        ));

        ?></p>
<?php endif;?>

<!--Форма создания подписок для пользователя Expert-->
<?php if ( $user->role->name == 'expert' ) :;?>

        <p> <h5>Список подписок:</h5>
        <?php
        $dataProvider = new CActiveDataProvider($user->model());
        $dataProvider->setData($user->subscriptions);
        $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'subscript-grid',
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array(
                    'name' => 'title',
                    'type' => 'raw',
                    'value' => 'CHtml::link(CHtml::encode($data->title),
                         array("private/updateSubscript","id" => $data->id))',
                ),
                'month_price',
                'week_price',

            ),
        ));

        ?></p>
    <?php $this->renderPartial('_subscript', array('user' => $user, 'subscript'=>$subscript)); ?>
<?php endif;?>

<!-- Форма заявки на подключение Rss для всех кроме пользователя Rss-->
<?php if ( $user->role->name != 'rss' ) :;?>
    <?php $this->renderPartial('_rssrequest', array('user' => $user, 'rssRequest'=>$rssRequest)); ?>
<?php endif;?>

<!-- Список фолловеров-->
<h4>Ваши subscripts:</h4>

<?php
$dataProvider = new CActiveDataProvider($user->model());
$dataProvider->setData($user->subscripts);
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'ссылка',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->name),
                         array("/user/index","id" => $data->id))',
        ),
        'name',
    ),
));
?>


<h4>Ваш счет:</h4>
<p>Сумма на счету: <?php echo sprintf("%0.0f", $user->getAmount()); ?></p>

<h6>Последние операции по счету:</h6>
<table>
    <thead>
    <tr><td>№</td><td>Дата</td><td>Сумма до операции</td><td>Приход</td><td>Расход</td><td>Тип операции</td><td>Остаток</td></tr>
    </thead>
    <?php foreach (array_slice($user->transactions,-10,10) as $transaction ): ?>
        <tr>
            <td><?php echo $transaction->id; ?></td>
            <td><?php echo strstr($transaction->time,'.',true); ?></td>
            <td><?php echo sprintf("%0.0f", $transaction->amount_before); ?></td>

            <td><?php
                $formatted = sprintf("%0.0f", $transaction->amount);
                if($formatted >0){
                    echo $formatted;
                }?></td>
            <td><?php if($formatted <0){
                    echo $formatted;
                }?></td>
            <td><?php echo $transaction->reason; ?></td>
            <td><?php echo sprintf("%0.0f", $transaction->amount_after) ?></td>
        </tr>

    <?php endforeach; ?>
</table>
<a href="<?php echo Yii::app()->createAbsoluteUrl('/private/deposit') ; ?>">Пополнить счет</a></p>
<a href="<?php echo Yii::app()->createAbsoluteUrl('/private/account') ; ?>">Полный список операций</a></p>


