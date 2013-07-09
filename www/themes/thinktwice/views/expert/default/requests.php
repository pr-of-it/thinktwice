<?php
/*
 * @var $this DefaultController
 * @var $user User
 */

$this->breadcrumbs=array(
    'Интерфейс эксперта' => array('/expert'),
    'Заявки на звонок'
);
?>

<h1>Заявки на консультации по телефону:</h1>

<?php

$dataProvider = new CActiveDataProvider($user->model());
$dataProvider->setData($user->getExpertCallRequests());
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'callrequest-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'ID',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),
                         array("callrequest","id" => $data->id))',
        ),
        array(
            'name' => 'Заказчик',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->user->name),
                         array("/user/index","id" => $data->user->id))',
        ),
        'title',
        'call_time',
        'duration',
    ),
));

?>