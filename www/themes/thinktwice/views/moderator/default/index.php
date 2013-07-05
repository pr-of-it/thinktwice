<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);?>
        <h4>Заявки на подключение RSS:</h4>

<?php
$dataProvider = new CActiveDataProvider($user->model());
$dataProvider->setData($user->getModeratorRssRequest());
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'callrequest-grid',
    'dataProvider'=>$dataProvider,
    'columns'=>array(

        'id',
        'blog.title',
        'blog.user.name',
        'title',
        'url',
        array(
            'class'=>'CButtonColumn',
            'template' => '{successRss} {failureRss}',
            'buttons' => array(
                'successRss' => array(
                    'label' => 'Подтвердить',
                    'url' => "Yii::app()->createUrl('moderator/default/successRssRequest', array('id'=>\$data->id))",
                ),
                'failureRss' => array(
                    'label' => 'Отклонить',
                    'url' => "Yii::app()->createUrl('moderator/default/failureRssRequest', array('id'=>\$data->id))",
            )
        ),
    ),

)));

?>