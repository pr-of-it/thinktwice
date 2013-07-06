<?php
/* @var $this Controller
 * $user User
 */
$user = User::model()->findByPk(Yii::app()->user->id);
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/main.css"/>
    <link media="print" type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/print.css"/>
    <meta name= "viewport" content="width=device-width, initial-scale=.85, user-scalable=yes">
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/ie.css" media="screen"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/selectivizr-min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/html5shiv.js"></script>
    <![endif]-->

    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/jquery-1.x.x.min.js"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/jquery-2.x.x.min.js"></script>
    <!--<![endif]-->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/scripts.js"></script>

    <!--[if lte IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/placeholder.js"></script>
    <![endif]-->

    <!--[if IE 9]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/PIE_IE9.js"></script>
    <![endif]-->

    <!--[if lte IE 8]>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/PIE_IE678.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/mustache.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/common.js"></script>
</head>
<body>

<header id="header">

    <div class="dashboard-link"></div>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a class="user-avatar" href="<?php echo $this->createAbsoluteUrl('/private'); ?>"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>164), 'crop'=>array('width'=>164, 'height'=>164))); ?><span></span></a>
        <div class="user-money"><a href="<?php echo $this->createAbsoluteUrl('/private/deposit'); ?>"><?php echo sprintf('%0.2f', $user->getAmount()); ?> руб.</a></div>
        <div class="user-name"><?php echo $user->name; ?></div>
    </section>

    <nav class="lenta-settings">
        <ul>
            <li><a class="icon-archive" href=""><span></span> Архив</a></li>
            <li>
                <a class="icon-filter" href=""><span></span> Фильтр</a>
                <div class="lenta-set-menu clear">
                    <ul class="set-cat-list">
                        <li class="cat-item-list">
                            <header>Тип инвестирования</header>
                            <ul class="cat-items clear">
                                <li class="cat-item">Фондовой рынок</li>
                                <li class="cat-item">Коллективные инвестиции</li>
                                <li class="cat-item">Альтернативные инвестиции</li>
                                <li class="cat-item">Недвижимость</li>
                                <li class="cat-item">Бизнес</li>
                            </ul>
                        </li>

                        <li class="cat-item-list">
                            <header>Подписки</header>
                            <ul class="cat-items clear">
                                <li class="cat-item">Покупка недвижимости за рубеж</li>
                                <li class="cat-item">Инвестиции в фондовый рынок</li>
                            </ul>
                        </li>

                        <li class="cat-item-list">
                            <header>Мои подписки</header>
                            <ul class="cat-items clear">
                                <li class="cat-item">Современное искусство</li>
                                <li class="cat-item">Вино Нового света</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a class="my-interest" href=""><span></span> Мои интересы</a></li>
        </ul>
        <div class="button-ok"></div>

        <ul class="interest-menu">
            <li>
                <a href="">
                    <header>Альтернативные инвестиции</header>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/icons/wine-big.png" alt=""/>
                </a>
            </li>
            <li>
                <a href="">
                    <h6>#LKOH</h6>

                    <p>Лукоил</p>
                </a>
            </li>
            <li>
                <a href="">
                    <h6>#GAZP</h6>

                    <p>Газпром</p>
                </a>
            </li>
            <li>
                <a href="">
                    <header>Фондовый рынок</header>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/icons/grap-big.png" alt=""/>
                </a>
            </li>
            <li class="im-desc">
                <a href="">
                    <header>Недвижимость</header>

                    <p>
                        Загородная недвижимость:
                        коттеджи, тайнхаусы, и если назва...
                    </p>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/icons/realty-big.png" alt=""/>
                </a>
            </li>
            <li>
                <a href="">
                    <header>Альтернативные инвестиции</header>

                    <p>Вина Нового света</p>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/icons/wine-big.png" alt=""/>
                </a>
            </li>
            <li>
                <a href="">
                    <h6>#TATN</h6>

                    <p>Ростелеком</p>
                </a>
            </li>
            <li>
                <a href="">
                    <header>Недвижимость</header>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/icons/realty-big.png" alt=""/>
                </a>
            </li>
            <li class="im-empty">
                <div></div>
            </li>
            <li>
                <a href="">
                    <h6>#VTBR</h6>

                    <p>Обыкновенные акции ВТБ</p>
                </a>
            </li>
            <li>
                <a href="">
                    <h6>#RTKM</h6>

                    <p>Ростелеком</p>
                </a>
            </li>
        </ul>
    </nav>

</header>
<div id="wrapper">
<!--header-->
<div id="container">
<div id="rails" class="page-lenta">
    <ul class="news-list full-item ajax-loader">
        <li class="ajax-loader-wrap">
            <div>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/ajax-loader-lenta.gif" alt=""/>
                <span>Возобновить загрузку</span>
            </div>
        </li>
    </ul>
</div>
</div>

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
            Я понимаю, что на iMac'е рисовать интерфейс клёво и крупные блоки в нём смотрятся отлично, но нужно
            ориентироваться и на экраны поменьше. А на экране поменьше более 2-х рядов блоков не помещается.
            Сделайте компактную плитку.
        </div>
        <div class="tag-attach-box">
            <input placeholder="Теги" type="text" name=""/>
            <ul class="attach-list">
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
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
                    <td>
                        <input class="button-yellow" type="submit" value="Опубликовать"/>
                    </td>
                </tr>
            </table>



        </footer>
    </form>
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
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image.png" alt=""/>
                <p>
                    Уже есть депозит на фондовом рынке? Заключаете сделки чаще одного раза в неделю? Тогда вы, если не
                    знакомы с понятием системной торговли, наверняка «сливаете» деньги. 
                    <br />
                    В рамках своего вебинара Михаил Сапенюк начнет с самых азов. Расскажет, что такое торговая
                    стратегия,
                    и
                    чем ожидание точки входа лучше слепого следования чьим-то сигналам или выполнения чьих-то
                    рекомендаций.Как написать систему и получить теоретическое обоснование ее работы.
                </p>
                <address class="author"><b>Ведомости</b> (56 подписчиков)</address>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/soc.png" alt=""/>
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
                            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                            <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
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
