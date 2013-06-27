<?php

$this->pageTitle=Yii::app()->name . ' - User page';
?>

    <h1>Страница пользователя</h1>
<table>
    <tr>
        <td>
            <p> <?php echo  CHtml::image(Yii::app()->baseUrl . $model->avatar);?> </p>

        </td>
        <td>
            <p>Имя пользователя:<?php echo $model->name;?></p>
            <p>Email:<?php echo $model->email;?></p>
            <p>Роль:<?php echo $model->role->desc;?></p>
            <p>Проводит консультации:<?php
                if ($model->can_consult === 1){
                    echo 'да'; ?>
                    <p>Стоимость консультации:<?php echo $model->consult_price;?></p>
<?php
                } else {
                    echo 'нет';
                };?></p>
            <p><?php ?></p>
            <?php

                    echo CHtml::link($label='Добавиться в фоловеры',
                    $url = Yii::app()->createAbsoluteUrl('/UserFollower/AddFollower',
                    array ('follower_id'=>$model->id)));

            ?>
         </td>
    </tr>

</table>


