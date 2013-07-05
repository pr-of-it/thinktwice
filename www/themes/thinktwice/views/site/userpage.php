<?php

$this->pageTitle=Yii::app()->name . ' - User page';
?>
<h1>Страница пользователя</h1>
<table>
    <tr>
        <td>
            <p> <?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>108, 'height'=>108)));?> </p>

        </td>
        <td>
            <p>Имя пользователя:<?php echo $user->name;?></p>
            <p>Email:<?php echo $user->email;?></p>
            <p>Роль:<?php echo $user->role->desc;?></p>
            <p>Проводит консультации:
                <?php
                if ($user->can_consult == 1){
                echo 'да'; ?>
            <p>Стоимость консультации: <?php echo $user->consult_price; ?>
                <br />
                <?php
                if ( $user->role->name == 'expert' ) {
                    echo CHtml::link($label='Заказать консультацию', $url = Yii::app()->createAbsoluteUrl('/private/callrequest',
                        array ('expert_id'=> $user->id,'consult_price'=>$user->consult_price)));
                }
                ?>
            </p>
            <?php
            } else {
                echo 'нет';
            }
            ?>
            <br />
            <?php
            if ( !Yii::app()->user->isGuest && $user->id != Yii::app()->user->id ) {

                if ( !$currentUser->doesFollow($user->id) ) {
                    echo CHtml::link($label='Добавиться в фоловеры',
                        $url = Yii::app()->createAbsoluteUrl('/site/addFollower',
                            array ('follower_id'=>$user->id)));
                }else{
                    echo CHtml::link($label = 'Удалиться из фолловеров',
                        $url = Yii::app()->createAbsoluteUrl('/site/delFollower',
                            array ( 'follower_id'=>$user->id )));
                }
            }
            ?>
        </td>
    </tr>

</table>


