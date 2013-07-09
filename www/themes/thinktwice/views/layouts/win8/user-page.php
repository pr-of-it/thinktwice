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
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/userpage.css"/>
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

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/mustache.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/common.js"></script>
</head>
<body>

<header id="header">

    <div class="dashboard-link"></div>
    <a href=""><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a class="user-avatar" href="<?php echo $this->createAbsoluteUrl('/private'); ?>"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>164), 'crop'=>array('width'=>164, 'height'=>164))); ?><span></span></a>
        <div class="user-money"><?php echo sprintf("%0.2f", $user->getAmount()); ?> руб.</div>
        <div class="user-name"><?php echo $user->name ?></div>
    </section>


<?php echo $content; ?>

</body>
</html>