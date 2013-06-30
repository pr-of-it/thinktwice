<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/mobile/css/style.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="target-densitydpi=device-dpi">
    <meta content="..." name="description">
    <meta content="..." name="keywords">
    <meta content="..." name="author">
    <meta name="MobileOptimized" content="width">
    <meta content="telephone=no" name="format-detection">
    <link rel="apple-touch-icon" sizes="114x114" href="114.png">
    <link rel="apple-touch-startup-image" href="...">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/js/modernizr.custom.32617.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/js/iscroll.js?v4"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/js/main.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="header">
    <header>
        <a href="" id="showMenu" title="Показать меню"><img src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/i/bg-menu.png" alt=""></a>
        <a href="" id="logo" title="Переход на главную"><img src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/i/logo.png" alt=""></a>
    </header>
</div>
<div id="wrapper">
    <div id="content">

        <?php echo $content; ?>

        <!--
        <div id="user-info" class="clearfix">
            <span class="ava"><img src="<?php echo Yii::app()->request->baseUrl; ?>/mobile/i/130711.jpg" alt=""></span>
            <h1 style="margin:6px 0;">Тим Черный</h1>
            <h2>1000 руб.</h2>
        </div>
        <div class="block bg-red">Ближайшая консультация: <b style="margin:8px 0;">26 апреля 2013</b></div>
        <a href="" title="" class="block bg-green">Ожидают подтверждения:<span class="count f-r">234</span></a>
        <a href="" title="" class="block bg-green">Ближайшие консультации:<span class="count f-r">234</span></a>
        <a href="" title="" class="block bg-green">График консультаций:<span class="count f-r">234</span></a>
        <a href="" title="" class="block bg-green">Стоимость моих консультаций:</a>
        <a href="" title="" class="block bg-green">Статистика:</a>
        <a href="" title="" class="block bg-green">Ближайшая консультация:</a>
        <a href="" title="" class="block bg-green">Ближайшая консультация:<span class="count f-r">234</span></a>
        <a href="" title="" class="block bg-green">Ближайшая консультация:</a>
        -->

    </div>
</div>
</body>
</html>