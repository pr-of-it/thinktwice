<?php
/* @var $this UserController */
/* @var $user User */
/* @var $currentUser User */
/* @var $model CallRequest */
/* @var $addedSubscription AddedSubscription*/
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(__DIR__.'/user.js')); ?>
<section class="user-title">
        <a class="icon-getback" href="<?php echo Yii::app()->request->baseUrl; ?>/"><span></span></a>
        <a class="user-avatar" href=""><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>79), 'crop'=>array('width'=>79, 'height'=>79))); ?><span></span></a>
        <div class="user-rating four"><?php $this->widget('ext.StarWidget.StarWidget', array('rating'=>$user->rating)); ?></div>
        <div class="user-name"><?php echo $user->name; ?></div>
        <div class="user-status">Независимый финансовый советник</div>
    </section>
    <section class="ask4advice">
        <a class="link-advice button-yellow"><span></span>Спросить совета</a><br>
        <div class="advice-price"><?php echo sprintf('%0.0f', $user->consult_price); ?> руб./мин.</div>
    </section>

</header>
<div id="wrapper">
<!--header-->
<div id="container">

<div id="rails" class="page-lenta userpage">
<div class="step-day">
    <ul class="news-list">
        <li class="news-item sidebar-nav">
            <a href="#">Видео презентация</a><br>
            <a href="#">Рекомендации</a><br>
            <a href="#">История успеха</a><br>
            <a href="#">Достижения</a><br>
            <a href="#">Проекты</a><br>
            <a href="#">Отзывы</a><br>
            <a href="#">Интервью</a><br>
            <a href="#">Вебинары</a><br>
            <a href="#">Блог и публикации</a>

        </li>
    </ul>


    <ul class="news-list full-item">
        <li class="news-item">
            <header>Видео презентация</header>
            <div class="content-box" type="video">
                <div class="content-body">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-video.png">
                </div>
                <div class="content-body">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-10years.png"
                         style="padding: 30px 10px;" title="10 лет работы в области финансов">
                </div>
            </div>
        </li>
    </ul>

    <?php if ($user->subscriptions != null): ?>
        <ul class="news-list full-item">
            <li class="news-item">
                <header>Подписки</header>
                <div class="content-box" type="subscribes">
                    <?php foreach ($user->subscriptions as $subscription) : ?>
                        <div class="content-body">
                            <header><?php echo $subscription->title; ?></header>
                            <div class="content-text"><?php echo $subscription->desc; ?></div>
                            <div class="content-price">
                                <?php echo $subscription->month_price == 0 ? $subscription->week_price
                                    . ' руб/нед' : $subscription->month_price . ' руб/мес' ?>
                            </div>
                            <?php
                            $i = 0;
                            $AddArray = array();
                            foreach ($addedSubscription as $add) {
                                $AddArray[$i] = $add->blog_id;
                                $i++;
                            }
                            if (!in_array($subscription->id, $AddArray, true)) :  ?>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('/blog/addSubscription',
                                    array('id' => $user->id, 'subscript' => $subscription->id));?>" class="link-addsub"><span></span></a>
                            <?php endif ?>
                        </div>
                    <?php endforeach ?>
                    <?php if ($user->id == $currentUser->id) : ?>
                        <div class="content-body">
                            <a href="<?php echo Yii::app()->createAbsoluteUrl('/private'); ?>" class="link-createsub">Создать
                                подписку</a>
                        </div>
                    <?php endif ?>
                </div>

            </li>
        </ul>
    <?php endif ?>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>История успеха</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="content-head">
                        <div class="orange-text">
                            <span style="font-size: 65px; line-height: 50px;">80%</span><br>
                            прибыли
                        </div>
                        <div class="white-text">
                            от<br>лучшей
                        </div>
                    </div>
                    <div class="content-text">Удивляюсь своей прозорливости. В прошлом и текущем годах всех клиентов всячески отговаривала от Кипра как юрисдикции для открытия счетов любого рода в силу неустойчивости экономического положения страны (известно, это часто чревато повышением налогов и не в лучшую сторону). Сегодня звонили, благодарили, а то сейчас бы на налог на депозиты попали.
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>Достижения</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="content-head">
                        <div class="orange-text">
                            <span style="font-size: 50px; line-height: 50px;">10</span><br>
                            лет
                        </div>
                        <div class="white-text">
                            работы в области<br> Финансов
                        </div>
                    </div>
                    <div class="content-text">
                        <div class="sup-member">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-fpa.png" style="float: left; margin-right: 15px; vertical-align: bottom;"><br>
                            Член Американской ассоциации<br> финансового планирования
                            <div style="clear: left;"></div>
                        </div>
                        <br>
                        Генеральный директор консалтинговой компании «Персональный советник», предоставляющей услуги в сфере личных финансов: составление личного инструментов, консультации по налогообложению.<br><br>
                        <a class="button-white-border" href="#">Смотреть резюме</a>
                    </div>
                </div>

            </div>
        </li>
    </ul>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>&nbsp;</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="content-head">
                        <div class="orange-text">

                            Более<br>
                            <span style="font-size: 55px; line-height: 50px;">160</span><br>
                        </div>
                        <div class="white-text">
                            реализованных<br>проектов
                        </div>
                    </div>
                    <br>
                    <div class="content-head">
                        <div class="orange-text">

                            Более<br>
                            <span style="font-size: 80px; line-height: 70px;">30</span><br>
                        </div>
                        <div class="white-text">
                            выступлений<br>на семинарах
                        </div>
                    </div>
                    <br>
                    <a class="button-white-border" href="#">Смотреть проекты</a>
                </div>
            </div>
        </li>
    </ul>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>Отзывы</header>
            <div class="content-box" type="reviews">
                <div class="content-body">

                    <div class="content-review">
                        <a class="user-avatar" href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-avatar3.png" alt=""/><span></span></a>
                        <div class="review-info">
                            <span class="review-date">вчера</span>
                            <span class="review-author">Иван Златоустов</span>
                            <span class="user-rating five"></span>
                        </div>
                        <div class="review-text">
                            Ваще офигенный чел. Кучу бабаок ему отвалил и еще отвалю, йо пис.
                        </div>
                        <div class="review-votes">
                            <a href="#" class="review-like"><span></span>5</a>
                            <a href="#" class="review-dislike"><span></span>5</a>
                        </div>
                    </div>
                    <div class="content-review">
                        <a class="user-avatar" href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-avatar2.png" alt=""/><span></span></a>
                        <div class="review-info">
                            <span class="review-date">01.03.13</span>
                            <span class="review-author">Дима Косарев</span>
                        </div>
                        <div class="review-text">
                            Ты че ваще говришь, он остой полный, ваще с ним нельзя иметь дело, позвонил мне а сам пьяный в хлам.
                        </div>
                        <div class="review-votes">
                            <a href="#" class="review-like"><span></span>5</a>
                            <a href="#" class="review-dislike"><span></span>5</a>
                        </div>
                    </div>
                    <div class="content-review">
                        <a class="user-avatar" href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-avatar2.png" alt=""/><span></span></a>
                        <div class="review-info">
                            <span class="review-author">Дима Косарев</span>
                            <span class="user-rating four"></span>
                        </div>
                        <div class="review-form">
                            <form>
                                <textarea placeholder="Ваш текст"></textarea>
                                <input type="submit" value="Отправить" class="button-roon">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </li>
    </ul>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>Интервью <a href="#">ВСЕ (5)</a></header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="interview-date">25.03.2012</div>
                    <div class="interview-head">Куда вложить деньги на лето?</div>
                    <div class="interview-text"><br>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-video2.png"><br><br>
                        Почему-то по-прежнему многие считают, что открыть брокерский счет с нулевым опытом инвестиций и нулевыми знаниями гораздо лучшая идея, чем инвестировать через фонды.
                        <br><br><a href="#">Читать расшифровку интервью</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <ul class="news-list full-item text-item">
        <li class="news-item">
            <header>&nbsp;</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="interview-date">25.03.2012</div>
                    <div class="interview-head">Вопрос не к банку, вопрос к заемщику</div>
                    <div class="interview-text"><br>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-video2.png"><br><br>
                        Почему-то по-прежнему многие считают, что открыть брокерский счет с нулевым опытом инвестиций и нулевыми знаниями гораздо лучшая идея, чем инвестировать через фонды.
                        <br><br><a href="#">Читать расшифровку интервью</a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <ul class="news-list full-item blog-item ">
        <li class="news-item">
            <header>Блог и публикации в СМИ</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="interview-date">25.03.2012</div>
                    <div class="interview-head">Куда вложить деньги на лето?</div>
                    <div class="interview-text"><br>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-image.png"><br><br>
                        Почему-то по-прежнему многие считают, что открыть брокерский счет с нулевым опытом инвестиций и нулевыми знаниямигораздо лучшая идея, чем инвестировать через фонды.
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <ul class="news-list full-item blog-item ">
        <li class="news-item">
            <header>&nbsp;</header>
            <div class="content-box" type="text">
                <div class="content-body">
                    <div class="interview-date">25.03.2012</div>
                    <div class="interview-head">Вопрос не к банку, вопрос к заемщику</div>
                    <div class="interview-text"><br>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-page-image2.png"><br><br>
                        Почему-то по-прежнему многие считают, что открыть брокерский счет с нулевым опытом инвестиций и нулевыми знаниямигораздо лучшая идея, чем инвестировать через фонды.
                    </div>
                </div>
            </div>
        </li>
    </ul>


</div>

</div>

</div>
<!--container-->

<footer id="footer">
    <ul class="footer-body clear">
        <li><a href="">Пользовательское соглашение</a></li>
        <li><a href="">Контакты</a></li>
        <li class="icon-mc"><a href=""></a></li>
        <li class="icon-visa"><a href=""></a></li>
        <li class="icon-tw"><a href=""></a></li>
        <li class="icon-fb"><a href=""></a></li>
    </ul>
</footer>
</div>
<!--wrapper-->

<div id="popup-wrapper">
    <div class="popup get-call">
        <?php $this->renderPartial('_callrequest', array(
            'user' => $user,
            'currentUser' => $currentUser,
            'model' => $model,
        )); ?>
        <div class="close-popup"></div>
    </div>
</div>

</body>
</html>