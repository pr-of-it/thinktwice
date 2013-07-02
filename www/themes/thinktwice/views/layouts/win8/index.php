<?php /* @var $this Controller */ ?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/main.css"/>
    <link media="print" type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/print.css"/>
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

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/common.js"></script>
</head>
<body>

<header id="header">

    <div class="dashboard-link"></div>
    <a href=""><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a href=""><img class="user-avatar" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/user-avatar.png" alt=""/></a>
        <div class="user-money">1000 руб.</div>
        <div class="user-name">Тим Черный</div>
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
<div class="step-day">
<header class="day-name">Сегодня</header>

<!-- Content -->
<?php echo $content; ?>
<!-- / Content -->


<?php /* ?>

<ul class="news-list">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">#GAZP</div>
            <div class="news-body">
                <header class="news-author">Ведомости</header>
                <h6>США и Газпром</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>10:02</span>
        </div>
    </li>



    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">#GAZP</div>
            <div class="news-body">
                <header class="news-author">Ведомости</header>
                <h6>США и Газпром</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>

            <div style="left:25%" class="time-slider"></div>

        </div>
        <div style="left:25%" class="time-dott">
            <span>5 минут назад</span>
        </div>
    </li>
</ul>

<ul class="news-list full-item">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Новости</div>
            <!-- Если картинка задана через CSS то она будет автоматически маштабироваться -->
            <div style="background-image: url(img/tmp/gallery-image-big.png);" class="image-gallery-min-full">
                <!--<img src="img/tmp/gallery-image-big.png" alt=""/>-->
            </div>
            <div class="news-body">

                <ul class="image-gallery-min">
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                </ul>
                <div class="time-create">15 минут назад</div>
                <header class="news-author">Даниил Маслов</header>
                <h6>Основной проект 55-й Венецианской биеннале посвящен базовой потребности...</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>
        </div>
        <div class="time-dott"></div>
    </li>
</ul>

<ul class="news-list medium-width">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">События</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float.png" alt=""/>
                <header class="news-author">Анна Карпова</header>
                <h6>Интервью с Ромео Ласерд</h6>

                <p>
                    По моему мнению, которое, честно скажу, коллеги не разделяют, выставка Джони
                    гуманистическая, принимающая человека... .человечество) со всеми его странностями и
                    тараканами в голове. И ключ к ней — видео Артура Жмиевского о слепых людях, на
                    ощупь, руками и ногами красящих на больших листах абстрактные изображения. Они
                    испытывают те же муки, сомнения и радости творчества, как и настоящие живописцы.

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLdotjQ8По
                    моему мнению, которое, честно скажу, коллеги не разделяют, выставка Джони
                    гуманистическая, принимающая человека... .человечество) со всеми его странностями и
                    тараканами в голове. И ключ к ней — видео Артура Жмиевского о слепых людях, на
                    ощупь, руками и ногами красящих на больших листах абстрактные изображения. Они
                    испытывают те же муки, сомнения и радости творчества, как и настоящие живописцы.

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLdotjQ8
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-users"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>

    <li class="news-item white-style">

        <div class="news-box">
            <div class="news-tag">Покупка недвижимости за рубежом</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/ava-white.png" alt=""/>
                <header class="news-author">Василий Ежевикин</header>
                <h6>Выручка «Синергии» по МСФО в 2012 году может вырмасти на 9% на фоне роста объемов
                    продаж водки.</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>

            <div style="left:80%" class="time-slider"></div>

        </div>
        <div style="left:80%" class="time-dott">
            <span>11:30</span>
        </div>
    </li>
</ul>

<ul class="news-list medium-width">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Прогнозы</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float-2.png" alt=""/>
                <header class="news-author">Вася Пупкин</header>
                <h6>Персональное финансовое планирование для тех, кто хочет уехать жить за рубеж</h6>

                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-wine"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>

    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Прогнозы</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float.png" alt=""/>
                <header class="news-author">Егор Репин</header>
                <h6>Современный рынок искусства</h6>

                <p>
                    Выставкой достижений мирового современного искусства основной проект биеннале в этом
                    году назвать невозможно. Обычно назначенный...

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLUqUPUSВыставкой
                    достижений мирового современного искусства основной проект биеннале в этом году
                    назвать невозможно. Обычно назначенный...

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLUqUPUS
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-wine"></a>

            <div style="left:30%" class="time-slider"></div>
        </div>
        <div style="left:30%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>
</ul>
</div>


<div class="step-day">
<header class="day-name">Вчера</header>
<ul class="news-list">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">#GAZP</div>
            <div class="news-body">
                <header class="news-author">Ведомости</header>
                <h6>США и Газпром</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>10:02</span>
        </div>
    </li>

    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">#GAZP</div>
            <div class="news-body">
                <header class="news-author">Ведомости</header>
                <h6>США и Газпром</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>

            <div style="left:25%" class="time-slider"></div>

        </div>
        <div style="left:25%" class="time-dott">
            <span>5 минут назад</span>
        </div>
    </li>
</ul>

<ul class="news-list full-item">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Новости</div>
            <!-- Если картинка задана через CSS то она будет автоматически маштабироваться -->
            <div style="background-image: url(img/tmp/gallery-image-big.png);"
                 class="image-gallery-min-full">
                <!--<img src="img/tmp/gallery-image-big.png" alt=""/>-->
            </div>
            <div class="news-body">

                <ul class="image-gallery-min">
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                    <li><a href=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/gallery-image.png" alt=""/></a></li>
                </ul>
                <div class="time-create">15 минут назад</div>
                <header class="news-author">Даниил Маслов</header>
                <h6>Основной проект 55-й Венецианской биеннале посвящен базовой потребности...</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-category"></a>
        </div>
        <div class="time-dott"></div>
    </li>
</ul>

<ul class="news-list medium-width">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">События</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float.png" alt=""/>
                <header class="news-author">Анна Карпова</header>
                <h6>Интервью с Ромео Ласерд</h6>

                <p>
                    По моему мнению, которое, честно скажу, коллеги не разделяют, выставка Джони
                    гуманистическая, принимающая человека... .человечество) со всеми его странностями и
                    тараканами в голове. И ключ к ней — видео Артура Жмиевского о слепых людях, на
                    ощупь, руками и ногами красящих на больших листах абстрактные изображения. Они
                    испытывают те же муки, сомнения и радости творчества, как и настоящие живописцы.

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLdotjQ8По
                    моему мнению, которое, честно скажу, коллеги не разделяют, выставка Джони
                    гуманистическая, принимающая человека... .человечество) со всеми его странностями и
                    тараканами в голове. И ключ к ней — видео Артура Жмиевского о слепых людях, на
                    ощупь, руками и ногами красящих на больших листах абстрактные изображения. Они
                    испытывают те же муки, сомнения и радости творчества, как и настоящие живописцы.

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLdotjQ8
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-users"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>


    <li class="news-item white-style">

        <div class="news-box">
            <div class="news-tag">Покупка недвижимости за рубежом</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/ava-white.png" alt=""/>
                <header class="news-author">Василий Ежевикин</header>
                <h6>Выручка «Синергии» по МСФО в 2012 году может вырмасти на 9% на фоне роста объемов
                    продаж водки.</h6>

                <p>
                    Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по производству
                    газа
                    и нефти...Состоялась поездка аналитиков и инвесторов на объекты «Газпрома» по
                    производству газа и нефти...Состоялась поездка аналитиков и инвесторов на объекты
                    «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков и
                    инвесторов
                    на объекты «Газпрома» по производству газа и нефти...Состоялась поездка аналитиков
                    и
                    инвесторов на объекты «Газпрома» по производству газа и нефти...Состоялась поездка
                    аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...Состоялась
                    поездка аналитиков и инвесторов на объекты «Газпрома» по производству газа и
                    нефти...
                </p>
                <span class="text-hide"></span>
            </div>

            <div style="left:80%" class="time-slider"></div>

        </div>
        <div style="left:80%" class="time-dott">
            <span>11:30</span>
        </div>
    </li>
</ul>

<ul class="news-list medium-width">
    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Прогнозы</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float-2.png" alt=""/>
                <header class="news-author">Вася Пупкин</header>
                <h6>Персональное финансовое планирование для тех, кто хочет уехать жить за рубеж</h6>

                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-wine"></a>

            <div class="time-slider"></div>
        </div>
        <div style="left:10%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>

    <li class="news-item">

        <div class="news-box">
            <div class="news-tag">Прогнозы</div>
            <div class="news-body">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/image-float.png" alt=""/>
                <header class="news-author">Егор Репин</header>
                <h6>Современный рынок искусства</h6>

                <p>
                    Выставкой достижений мирового современного искусства основной проект биеннале в этом
                    году назвать невозможно. Обычно назначенный...

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLUqUPUSВыставкой
                    достижений мирового современного искусства основной проект биеннале в этом году
                    назвать невозможно. Обычно назначенный...

                    Читайте далее:
                    http://www.vedomosti.ru/lifestyle/news/12690421/tvorit_bazovaya_potrebnost#ixzz2VLUqUPUS
                </p>
                <span class="text-hide"></span>
            </div>
            <div class="news-like">5</div>
            <a href="" class="icon-wine"></a>

            <div style="left:30%" class="time-slider"></div>
        </div>
        <div style="left:30%" class="time-dott">
            <span>40 минут назад</span>
        </div>
    </li>
</ul>
</div>
</div>
  <?php */ ?>

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
                </p>
                <p>
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
