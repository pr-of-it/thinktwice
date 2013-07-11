<?php
/* @var $this PrivateController */
/* @var $user User */
/* @var $model CallRequest */
/* @var $form ActiveForm */
?>
<section class="popup-content">
    <div class="scroll">
        <section class="popup-sidebar">
            <header class="popup-head">Услуги</header>
            <div class="describe">Консультация по телефону<br><?php echo sprintf('%0.0f', $user->consult_price); ?> руб./мин.</div>
            <div class="expert">
                <span class="header">Альтернативные инвестиции</span>
                <a class="user-avatar" href=""><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>50), 'crop'=>array('width'=>50, 'height'=>50))); ?><span></span></a>
                <span class="user-name"><?php echo $user->name; ?></span>
                <div class="call-time">
                    <span>Сегодня с 15 до 17</span><br>
                    <span>Завтра с 15 до 17</span><br>
                    <span>1 августа с 15 до 17</span><br>
                </div>
                <div class="call-cost">
                    <span class="call-charge"><?php echo $user->consult_price * 15;?></span>
                    <span class="call-duration">15 минут</span>
                </div>
                <div class="do-confirm">
                    <?php if ( $user->phone_verified ): ?>
                    <div class="confirm-number">
                        <span class="header">Подтвердить номер телефона</span><br>
                        <span class="text">+7</span><input type="text" size="3" name="" value="<?php echo substr($user->phone, 1, 3); ?>"><input type="text" size="7" name="" value="<?php echo substr($user->phone, 4, 7); ?>"><input type="button" class="button-dark change-phone" value="Отправить"><br><br><br>
                        <span class="text code-label">Введите код</span><input type="text" size="5" name=""><br><br><br>
                        <input type="button" class="button-yellow confirm" value="Подтвердить">
                        <p class="error">Введите правильный код</p>
                    </div>
                    <?php else : ?>
                    <div class="change-number">
                        <span class="header">Ваш номер телефона:</span><br>
                        <span class="text">+7</span><input type="text" size="3" name="" value="<?php echo substr($user->phone, 1, 3); ?>"><input type="text" size="7" name="" value="<?php echo substr($user->phone, 4, 7); ?>"><br>
                        <input type="button" class="button-yellow change-phone" value="Изменить">
                        <p class="error">Введите правильный номер телефона</p>
                        <div class="confirm-number-2" style="display:none">
                            <span class="text code-label">Введите код</span><input type="text" size="5" name=""><br><br><br>
                            <input type="button" class="button-yellow confirm" value="Подтвердить">
                            <p class="error">Введите правильный код</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <br><br>
                <input type="button" class="button-yellow" value="Купить" onclick="$('#callrequest-form').submit();">

            </div>
        </section>
        <section class="popup-helper">
            <header class="popup-head">Заказать звонок</header>
            <?php $form=$this->beginWidget('ActiveForm', array(
                'id'=>'callrequest-form',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of ActiveForm for details on this.
                'enableAjaxValidation'=>false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'class' => 'create-call-request'
                ),
            )); ?>

            <?php echo $form->textField($model,'title',array('placeholder' => 'Тема Вашего вопроса')); ?>
            <?php echo $form->error($model,'title'); ?>

            <?php echo $form->textArea($model,'text',array('placeholder' => 'Содержание Вашего вопроса')); ?>
            <?php echo $form->error($model,'text'); ?>


            <div class="attachments">
                <a href=""><span class="ico-clip"></span>Отправьте эксперту документ или фотографию,<br>чтобы лучше объяснить что вы хотите узнать</a>
            </div>

            <h4 class="right">Стоимость</h3>
                <h4>Сколько времени займет консультация</h3>
                    <div id="slider-result"><?php echo $user->consult_price * 15;?></div>
                    <span class="slider-time">15 мин.</span>
                    <div class="slider" id="slider"></div>
                    <span class="slider-time">1 час</span>
                    <div id="min"></div>
                    <?php echo $form->hiddenField($model,'duration'); ?>
                    <input type="hidden" id="hidden"/>

                    <div class="cf"></div>
                    <br><br>
                    <h4>Когда вы хотите чтобы вам позвонили</h4>
                    <div class="call-time-holder">
                        <span class="call-me">Позвоните мне</span><div class="call-time-select">Сегодня с 11 до 13</div>
                        <div class="call-time-data">
                            <div id="call-tabs-1">
                                <ul>
                                    <li><a href="#day1">Сегодня</a></li>
                                    <li><a href="#day2">Завтра</a></li>
                                    <li><a href="#day3">1 августа</a></li>
                                    <li><a href="#day4">2 августа</a></li>
                                </ul>
                                <div class="time-var" id="day1">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day2">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                </div>
                                <div class="time-var" id="day3">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day4">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="call-time-holder">
                        <span class="call-me">Или</span><div class="call-time-select">Завтра с 11 до 13</div>
                        <div class="call-time-data">
                            <div id="call-tabs-2">
                                <ul>
                                    <li><a href="#day5">Сегодня</a></li>
                                    <li><a href="#day6">Завтра</a></li>
                                    <li><a href="#day7">1 августа</a></li>
                                    <li><a href="#day8">2 августа</a></li>
                                </ul>
                                <div class="time-var" id="day5">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day6">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                </div>
                                <div class="time-var" id="day7">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day8">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="call-time-holder">
                        <span class="call-me">А еще можно</span><div class="call-time-select">1 августа с 11 до 13</div>
                        <div class="call-time-data">
                            <div id="call-tabs-3">
                                <ul>
                                    <li><a href="#day9">Сегодня</a></li>
                                    <li><a href="#day10">Завтра</a></li>
                                    <li><a href="#day11">1 августа</a></li>
                                    <li><a href="#day12">2 августа</a></li>
                                </ul>
                                <div class="time-var" id="day9">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day10">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                </div>
                                <div class="time-var" id="day11">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 15 до 17 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                                <div class="time-var" id="day12">
                                    <span>с 11 до 13 часов</span>
                                    <span>с 17 до 19 часов</span>
                                    <span>с 19 до 21 часов</span>
                                    <span>с 21 до 23 часов</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
        </section>
    </div>
</section>

<?php if ( $form->errorSummary($model) ) : ?>
    <script>
        $('.get-call').popup();
    </script>
<?php endif; ?>

<script>
    window.USER = {
        consult_price: "<?php echo $user->consult_price; ?>"
    }
</script>
