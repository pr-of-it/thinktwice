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

<?php foreach ( $user->getExpertCallRequests() as $request ) :?>
    <div class="block bg-gray b-shadow confirmation">
        <div class="block bg-red txt-c" style="padding-left:20px !important; margin-bottom:30px !important;"><?php echo $request->call_time ?></div>
        <p>Вопрос:
            <span><?php echo $request->title; ?></span></p>
        <p>Текст:
            <span><?php echo $request->text; ?></span></p>
        <p>Файлы:<br><a href="" title="" class="block bg-doc">Список вопросов</a><a href="" class="block bg-doc" title="">Текст консультации</a></p>
        <p>Альтернативное время консультации:
            <span><?php echo $request->alter_call_time_1; ?></span>
            <span><?php echo $request->alter_call_time_2; ?></span>
        </p><?php if ( $request->alter_call_time_1 != $request->call_time ) :?>
                <div class="table" style="margin:0 !important;">
                    <?php echo CHtml::link(
                        'Перенести на ' . $request->alter_call_time_1,
                        array(
                            'default/callTransfer/',
                            'id'=>$request->id,
                            'call_time'=>$request->alter_call_time_1,
                        ),
                        array(
                            'class' => 'but but-yellow',
                        )
                    );
                    ?>
                </div>
            <?php endif;?>
        <?php if ( $request->alter_call_time_2 != $request->call_time ) :?>
            <div class="table" style="margin:0 !important;">
                <?php echo CHtml::link(
                    'Перенести на ' . $request->alter_call_time_2,
                    array(
                        'default/callTransfer/',
                        'id'=>$request->id,
                        'call_time'=>$request->alter_call_time_2,
                    ),
                    array(
                        'class' => 'but but-yellow',
                    )
                );
                ?>
            </div>
        <?php endif?>
        <div class="table" style="margin:0 !important;">
            <?php echo CHtml::link('Подтвердить',
                array(
                    'default/updateStatus/',
                    'id'=>$request->id,
                    'call_time'=>$request->call_time,
                    'status'=>CallRequest::STATUS_ACCEPTED,
                ),
                array(
                    'class' => 'but but-yellow',
                )
            );
            ?>
        </div>
    </div>
<?php endforeach ?>
