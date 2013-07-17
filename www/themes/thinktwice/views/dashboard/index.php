<?php  $_u = !Yii::app()->user->isGuest ? false : true; ?>

<div id="container">

<?php
    if ( !Yii::app()->request->cookies->contains('notShowVideo')
        || Yii::app()->request->cookies['notShowVideo']->value==0) :

?>
<div id="rails" class="page-lenta page-dashboard quick-start">
<div class="quick-start-box">
    <header>О проекте</header>
        <div class="video-box">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/tmp/video.jpg" alt=""/>

        <div class="content">
            Рассказываю про то как быстро заработать миллион на бирже, многоходовкие, уловки, трюки и приемы —
            это ко мне.
            В основном могу по вечерам, но бывают просветления и днями. В общем, что я вам все рассказываю?<br/>
            Рассказываю
            про то как быстро заработать миллион на бирже, многоходовкие, уловки, трюки и приемы —
            это ко мне.
            В основном могу по вечерам, но бывают просветления и днями. В общем, что я вам все рассказываю?<br/>
            Рассказываю
            про то как быстро заработать миллион на бирже, многоходовкие, уловки, трюки и приемы —
            это ко мне.
            В основном могу по вечерам, но бывают просветления и днями. В общем, что я вам все рассказываю?
            <br/>Рассказываю
            про то как быстро заработать миллион на бирже, многоходовкие, уловки, трюки и приемы —
            это ко мне.
            В основном могу по вечерам, но бывают просветления и днями. В общем, что я вам все рассказываю?
            <br/>Рассказываю
            про то как быстро заработать миллион на бирже, многоходовкие, уловки, трюки и приемы —
            это ко мне.
            В основном могу по вечерам, но бывают просветления и днями. В общем, что я вам все рассказываю?
        </div>

        <div class= "close" ></div>
    </div>
</div>

<?php else : ?>
<div id="rails" class="page-lenta page-dashboard">

<?php endif ?>

<ul class="main-panel clear">
<li class="header">Главное</li>
<li class="mp-row">

<ul class="mp-level-list">
<li class="mp-level">

    <ul class="cells-50 clear">
        <li class="cell-50<?php echo $_u ? ' disabled' : ''; ?>">

            <?php if ( $_u == false ) :?>
            <a href="<? echo Yii::app()->createAbsoluteUrl('/users'); ?>">
                <?php endif ?>
                <div class="w8-cell yellow-cell icon-center-user">
                <div class="cell-name">Люди</div>
            </div></a>

        </li>
        <li class="cell-50">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index');?>">
            <div class="w8-cell red-cell icon-center-w">
                <div class="cell-name">Лента</div>
                <div class="count">15</div>
            </div></a>

        </li>
    </ul>

</li>

<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Уведомления</div>
        <img class="cell-image" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/icon-bb.png"
             alt=""/>
    </div>

</li>

<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Фондовый рынок</div>
        <img class="cell-image"
             src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/grap-big-2.png" alt=""/>
    </div>

</li>

<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Коллективные инвестиции</div>
        <img class="cell-image"
             src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/icon-user-big.png" alt=""/>
    </div>

</li>

<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Недвижимость</div>
        <img class="cell-image"
             src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/realty-big-2.png" alt=""/>
    </div>

</li>

<li class="mp-level">

    <ul class="cells-50 clear">
        <li class="cell-50">

            <a href="<?php { echo Yii::app()->createAbsoluteUrl('/help');}?>">
                <div class="w8-cell cell-full blue-cell">
                    <div class="cell-name">Помощь</div>
                </div></a>

        </li>
        <li class="cell-50<?php echo $_u ? ' disabled' : ''; ?>">
            <?php if ( $_u == false ) :?>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('/private');?>">
                <?php endif ?>
                <div class="w8-cell cell-full blue-cell">
                    <div class="cell-name">Я</div>
                </div></a>

        </li>
    </ul>

</li>

<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Альтернативные инвестиции</div>
        <img class="cell-image"
             src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/wine-big-2.png" alt=""/>
    </div>

</li>



<li class="mp-level<?php echo $_u ? ' disabled' : ''; ?>">

    <div class="w8-cell cell-full blue-cell">
        <div class="cell-name">Инвестиции в бизнес</div>
        <img class="cell-image" src="<?php echo Yii::app()->request->baseUrl; ?>/win8/dashboard/img/icons/icon-bb.png"
             alt=""/>
    </div>

</li>
</ul>

</li>
</ul>


</div>

</div>
<!--container-->