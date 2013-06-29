<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);

?>
    <h4>Заявки на консультации:</h4>
    <?php

    $dataProvider = new CActiveDataProvider($user->model());
    $dataProvider->setData($user->getOperatorCallRequests());
echo '<pre>';
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
            'caller_id',
            'title',
            'call_time',
            'duration',
        ),
    ));

?>