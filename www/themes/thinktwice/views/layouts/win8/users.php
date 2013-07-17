<?php
/* @var $this Controller
 * $user User
 */
$user = User::model()->findByPk(Yii::app()->user->id);
?><!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/main.css"/>
    <link media="print" type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/print.css"/>
    <meta name= "viewport" content="width=device-width, initial-scale=.8, user-scalable=no">
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

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

</head>
<body class="users">

<header id="header">

    <a href="<?php echo Yii::app()->createAbsoluteUrl('/dashboard')?>"><div class="dashboard-link">
        <ul>
            <li class="dl-1"></li>
            <li class="dl-2"></li>
            <li class="dl-3"></li>
            <li class="dl-4"></li>
            <li class="dl-5"></li>
        </ul>
        <div>Дашборд <span></span></div></a>
        <!--<a class="icon-flash" href=""></a>-->
    </div>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a class="user-avatar" href="<?php echo $this->createAbsoluteUrl('/private'); ?>"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>164), 'crop'=>array('width'=>164, 'height'=>164))); ?><span></span></a>
        <div class="user-money"><a href="<?php echo $this->createAbsoluteUrl('/private/deposit'); ?>"><?php echo sprintf('%0.0f', $user->getAmount()); ?> руб.</a></div>
        <div class="user-name"><?php echo $user->name; ?></div>
    </section>

    <nav class="lenta-settings page-users">
        <!--
        <ul>
            <li>
                <h1>Пользователи</h1>
            </li>
            <li><div class="check-all-lebel">Все</div> <a class="my-interest expert-only" href=""><span></span> <i>Только эксперты</i></a></li>
        </ul>
        <div class="button-ok"></div>
        -->

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

    <div class="filter-by">
        <div>Тег</div>
        <ul class="clear">
            <li><span>Недвижимость</span> <div></div></li>
        </ul>
    </div>

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

</body>
</html>