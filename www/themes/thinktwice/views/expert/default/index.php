<?php
/*
 * @var $this DefaultController
 * @var $user User
 */

$this->breadcrumbs=array(
    $this->module->id,
);
?>

    <div id="user-info" class="clearfix">
        <span class="ava"><img src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/i/130711.jpg" alt=""></span>
        <h1 style="margin:6px 0;"><?php echo $user->name; ?></h1>
        <h2><?php echo sprintf('%0.2f', $user->amount); ?>&nbsp;руб.</h2>
    </div>
    <div class="block bg-red">Ближайшая консультация: <b style="margin:8px 0;">** апреля 20**</b></div>
    <a href="" title="" class="block bg-green">Ожидают подтверждения:<span class="count f-r"><?php echo count($user->getExpertCallRequests()); ?></span></a>
    <a href="" title="" class="block bg-green">Ближайшие консультации:<span class="count f-r">**</span></a>
    <a href="" title="" class="block bg-green">График консультаций:<span class="count f-r">**</span></a>
    <a href="<?php echo $this->createUrl('price'); ?>" title="" class="block bg-green">Стоимость моих консультаций: <?php echo sprintf('%0.2f', $user->consult_price); ?>&nbsp;руб.</a>
    <a href="" title="" class="block bg-green">Статистика:</a>


<?php /* ?>
    <h1>Заявки на консультации:</h1>
<?php

$dataProvider = new CActiveDataProvider($user->model());
$dataProvider->setData($user->getExpertCallRequests());
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'callrequest-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'заявка',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),
                         array("callrequest","id" => $data->id))',
        ),
        array(
            'name' => 'Заказчик',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->user->name),
                         array("../site/userpage","id" => $data->user->id))',
        ),
        'title',
        'call_time',
        'duration',
    ),
));

?>

 <?php */ ?>
