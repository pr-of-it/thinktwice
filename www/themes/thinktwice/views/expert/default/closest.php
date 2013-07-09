<?php
$this->breadcrumbs=array(
'Интерфейс эксперта' => array('/expert'),
'Заявки на звонок'
);
?>

<h1>Заявки на консультации по телефону:</h1>

<?php

$dataProvider = new CActiveDataProvider($user->model());
$dataProvider->setData($user->getExpertClosest());
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'closest-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'ID',
            'type' => 'raw',
            'value' => 'CHtml::link(CHtml::encode($data->id),
                         array("finishedcallrequest","id" => $data->id))',
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