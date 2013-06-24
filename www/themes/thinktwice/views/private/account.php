<?php $this->breadcrumbs=array(
'Личный кабинет'=>array('index'),
'Полный список операций',
);?>
<table>
    <thead>
        <tr><td>№</td><td>Дата</td><td>Сумма до операции</td><td>Приход</td><td>Расход</td><td>Тип операции</td><td>Остаток</td></tr>
    </thead>
    <?php
    foreach ($models as $model): ?>

    <tr>
        <td><?php echo $model->id; ?></td>
        <td><?php echo strstr($model->time,'.',true); ?></td>
        <td><?php echo sprintf("%01.2f", $model->amount_before); ?></td>

        <td><?php
            $formatted = sprintf("%01.2f", $model->amount);
            if($formatted >0){
                echo $formatted;
            }?></td>
        <td><?php if($formatted <0){
                echo $formatted;
            }?></td>
        <td><?php echo $model->reason; ?></td>
        <td><?php echo sprintf("%01.2f", $model->amount_after) ?></td>
    </tr>

<?php endforeach; ?>
</table>
<?$this->widget('CLinkPager', array(
    'pages' => $pages,
))?>