<?php
/* @var $this Controller
 * $user User
 */
$user = User::model()->findByPk(Yii::app()->user->id);
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/main.css"/>
    <link media="print" type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/print.css"/>
    <meta name= "viewport" content="width=device-width, initial-scale=.8, user-scalable=no">
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/win8/css/ie.css" media="screen"/>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/selectivizr-min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/html5shiv.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/css3-mediaqueries.js"></script>
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
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/ckeditor/lang/ru.js"></script>

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/mustache.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/js/common.js?1014"></script>
</head>
<body class="index authenticated">

<header id="header">

    <a href="<?php echo Yii::app()->createAbsoluteUrl('/dashboard')?>"><div class="dashboard-link">
        <ul>
            <li class="dl-1"></li>
            <li class="dl-2"></li>
            <li class="dl-3"></li>
            <li class="dl-4"></li>
            <li class="dl-5"></li>
        </ul>
        <div>Дашборд <span></span></div>
    </div></a>
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/"><img id="logo" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/logo.png" alt=""/></a>

    <section class="user-bar">
        <a class="user-avatar" href="<?php echo $this->createAbsoluteUrl('/private'); ?>"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>164), 'crop'=>array('width'=>164, 'height'=>164))); ?><span></span></a>
        <div class="user-money"><a href="<?php echo $this->createAbsoluteUrl('/private/deposit'); ?>"><?php echo sprintf('%0.0f', $user->getAmount()); ?> руб.</a></div>
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

<div id="popup-wrapper">
<div class="popup window-post">
    <section class="popup-content">
        <form class="scroll" id="blog-edit-form" action="/site/index" method="post">

        <div class="file-upload-wrapper">
            <div class="file-upload-container">
                <ul class="attach-list">
                </ul>
                <?php $this->widget('ext.EFineUploader.EFineUploader', array(
                    'id'=>'FineUploader_Edit',
                    'config' => array(
                        'autoUpload'=>true,
                        'request' => array(
                            'endpoint' => $this->createUrl('blog/ajaxUploadImage'),
                            'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                        ),
                        'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                        'chunking'=>array('enable'=>true,'partSize'=>100),
                        'callbacks'=>array(
                            'onComplete'=>"js:function(id, name, response){
                                        $('li.qq-upload-success').remove();
                                        var imageInput = $('<input class=\"hidden-image\" type=\"hidden\" name=\"BlogPost[images][]\" value=\"/upload/blogs/' + response.filename + '\" />');
                                        $('.window-post .file-upload-container').append(imageInput);
                                        $('#blog-edit-form .attach-list:not(.media-list)').append('<li><img src=\"/upload/blogs/' + response.filename + '\"></li>')
                                    }",
                            //'onError'=>"js:function(id, name, errorReason){ }",
                        ),
                        'validation'=>array(
                            'allowedExtensions'=>array('jpg','jpeg','png','gif'),
                            'sizeLimit' => 2 * 1024 * 1024,//maximum file size in bytes
                            //'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                        ),
                        /*'messages'=>array(
                                          'tooManyItemsError'=>'Too many items error',
                                          'typeError'=>"Файл {file} имеет неверное расширение. Разрешены файлы только с расширениями: {extensions}.",
                                          'sizeError'=>"Размер файла {file} велик, максимальный размер {sizeLimit}.",
                                          'minSizeError'=>"Размер файла {file} мал, минимальный размер {minSizeLimit}.",
                                          'emptyError'=>"{file} is empty, please select files again without it.",
                                          'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                         ),*/
                    )
                )); ?>
                <?php //echo $form->hiddenField($model,'image'); ?>
            </div>
        </div>
        </form>
        <div class="scroll">
            <header class="popup-head">&nbsp;</header>
            <div class="article-info">
                <!--<span class="viewings">
                    <span></span>
                    250
                </span>
                <span class="shared">Поделилось: 5</span>-->
                <a href="" class="user-avatar">
                    <img src=""><span></span>
                </a>
                <a href="" class="user-name">Автор</a>
            </div>
            <article class="content">
                <div class="window-post-image"></div>
                <div class="window-post-text">
                    &nbsp;
                </div>
                <address class="author"><b>Ведомости</b> (56 подписчиков)</address>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/soc.png" alt=""/>
            </article>
        </div>
    </section>
    <div class="edit-post-button" style="display:none"></div>
    <div class="close-popup"></div>
</div>
</div>


</body>
</html>
