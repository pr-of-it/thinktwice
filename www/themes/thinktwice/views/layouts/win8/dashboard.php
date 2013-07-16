<?php
/* @var $this Controller
 * $user User
 */
$user = User::model()->findByPk(Yii::app()->user->id);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/css/main.css"/>
    <link media="print" type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/css/print.css"/>
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/css/ie.css" media="screen"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/selectivizr-min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/html5shiv.js"></script>
    <![endif]-->

    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/jquery-1.x.x.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/jquery-2.x.x.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/scripts.js"></script>

    <!--[if lte IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/placeholder.js"></script>
    <![endif]-->

    <!--[if IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/PIE_IE9.js"></script>
    <![endif]-->

    <!--[if lte IE 8]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/PIE_IE678.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/js/common.js"></script>

    <script type="text/javascript">
        // если юзер авторизован то эта переменная несет имя
        var user_id = 'null'
    </script>
</head>
<body>

<header id="header">

    <div class="dashboard-link">
        <ul>
            <li class="dl-1"></li>
            <li class="dl-2"></li>
            <li class="dl-3"></li>
            <li class="dl-4"></li>
            <li class="dl-5"></li>
        </ul>
        <div>Дашборд <span></span></div>
    </div>
    <a href=""><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a class="user-avatar" href="<?php echo $this->createAbsoluteUrl('/private'); ?>"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>164), 'crop'=>array('width'=>164, 'height'=>164))); ?><span></span></a>

        <a href="" class="setting-icon"></a>
        <div class="user-money"><a href="<?php echo $this->createAbsoluteUrl('/private/deposit'); ?>"><?php echo sprintf('%0.0f', $user->getAmount()); ?> руб.</a></div>
        <div class="user-name"><?php echo $user->name; ?></div>
    </section>

</header>
<div id="wrapper">

<?php echo $content; ?>

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

<div class="popup window-post">
    <section class="popup-content">
        <div class="scroll">
            <header class="popup-head">Новости рынка труда</header>
            <div class="article-info">
				<span class="viewings">
					<span></span>
					250
				</span>
                <span class="shared">Поделилось: 5</span>
            </div>
            <article class="content">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/tmp/image.png" alt=""/>
                <p>
                    Уже есть депозит на фондовом рынке? Заключаете сделки чаще одного раза в неделю? Тогда вы, если не
                    знакомы с понятием системной торговли, наверняка «сливаете» деньги. 
                </p>
                <p>
                    В рамках своего вебинара Михаил Сапенюк начнет с самых азов. Расскажет, что такое торговая
                    стратегия, и
                    чем ожидание точки входа лучше слепого следования чьим-то сигналам или выполнения чьих-то
                    рекомендаций.Как написать систему и получить теоретическое обоснование ее работы.
                </p>
                <address class="author"><b>Ведомости</b> (56 подписчиков)</address>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/tmp/soc.png" alt=""/>
            </article>
        </div>
    </section>
    <div class="close-popup"></div>
</div>

<div class="popup window-post-edit">
    <section class="popup-content">
        <div class="scroll">
            <header class="popup-head">Редактировать совет</header>
            <div class="create-post opacity-hide">
                <form action="/" class="create-post-content">
                    <header>
                        <input placeholder="Тема моего совета" type="text" name=""/>
                        <ul class="controlls-fonts">
                            <li class="set_font-bold">b</li>
                            <li class="set_font-italic">i</li>
                            <li class="set_font-link">link</li>
                            <li class="set_font-fullscreen">на весь экран</li>
                        </ul>
                    </header>
                    <div class="text-field" contenteditable="true">
                        Я понимаю, что на iMac'е рисовать интерфейс клёво и крупные блоки в нём смотрятся отлично, но
                        нужно
                        ориентироваться и на экраны поменьше. А на экране поменьше более 2-х рядов блоков не помещается.
                        Сделайте компактную плитку.
                    </div>
                    <div class="tag-attach-box">
                        <input placeholder="Теги" type="text" name=""/>
                        <ul class="attach-list">
                            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/tmp/city.png" alt=""/></li>
                            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/tmp/city.png" alt=""/></li>
                            <li class="add-attach"></li>
                        </ul>
                    </div>
                    <footer>
                        <table>
                            <tr>
                                <!--<td><a class="add-element" href=""><span></span></a></td>-->
                                <td class="width-select-1">
                                    <select name="">
                                        <option value="">Название моей подписки</option>
                                        <option value="">Выбор 1</option>
                                        <option value="">Выбор 2</option>
                                    </select>
                                </td>
                                <td class="width-select-2">
                                    <select name="">
                                        <option value="">для всех</option>
                                        <option value="">Выбор 1</option>
                                        <option value="">Выбор 2</option>
                                    </select>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="line-buttons" colspan="3">
                                    <a class="button-cancel" href="">Отменить</a>
                                    <input class="button-yellow" type="submit" value="Опубликовать изменения"/>
                                </td>
                            </tr>
                        </table>


                    </footer>
                </form>
            </div>
        </div>
    </section>
    <div class="close-popup"></div>
</div>

<div class="popup window-post-2">
    <section class="popup-content">
        <div class="scroll">
            <header class="popup-head">Торговая рекомендация</header>
            <article class="content">
                <h3>Потенциал — 15% на росте акций Сбербанка</h3>
                <h4>Что требуется: </h4>
                <ul>
                    <li>от 1000 руб. свободные денежные средства</li>
                    <li>2-3 месяца что ожидать через 6 месяцев?</li>
                    <li>брокерский счет</li>
                </ul>

                <h4>Стратегия</h4>
                <p>
                    Приобретать обыкновенные акции Сбербанка по цене ниже 82 рублей за акцию и продавать, когда цена
                    достигнет 94 рублей. Заемные денежные средства не использовать.
                </p>

                <h4>Почему</h4>

                <p>
                    Иностранные и российские инвесторы не заинтересованы долго держать в низкодоходных активах
                    свободные деньги. Сбербанк выглядит самым инвестиционно привлекательным активом в банковском
                    секторе. ссылка на источник. Учитывая недооцененность акций (на 50%) даже при намеке на
                    стабилизацию экономики ЕС рост котировок может быть взрывным.
                    <br /><br/>
                    <a href="">Ссылка на аналитику</a>
                </p>

                <h3>Как купить?</h3>
            </article>
        </div>
    </section>
    <div class="close-popup"></div>
</div>

</body>
</html>