<?php
/* @var $this Controller
 * @var $currentUser User
 * @var $experts User[]
 * @var $feeds User[]
 * @var $users User[]
 */
?>
<div id="container">

<div id="rails" class="page-users">
<ul class="users-list-wrap clear">

<li class="users-list-box users-list-row-2">
    <header>Я подписался <span>Всего (<?php echo count($currentUser->subscripts); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($currentUser->subscripts as $subscript) : ?>

            <?php if ( $subscript->role->name == 'expert' ) : ?>
            <li class="users-item user-premium">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($subscript->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><?php echo $subscript->name; ?></header>
                    <div class="desc">Специалист методологии</div>
                    <div class="price-time"><?php echo sprintf('%0.0f', $subscript->consult_price); ?> руб./мин.</div>
                </div>
                <div class="close"></div>
            </li>
            <?php else : ?>
                <li class="users-item">
                    <div class="user-content">
                        <div class="avatar-rating">
                            <?php echo Yii::app()->easyImage->thumbOf($subscript->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                            <span></span>
                        </div>
                        <header class="name"><?php echo $subscript->name; ?></header>
                        <div class="desc">UNI <br/> Дизайнер</div>
                    </div>
                    <div class="unfollow"></div>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>

    </ul>
</li>

<li class="users-list-box users-list-row-3">
    <header>Эксперты <span>Всего (<?php echo count($experts); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($experts as $expert) : ?>

        <li class="users-item user-premium">
            <div class="user-content">
                <div class="avatar-rating">
                    <?php echo Yii::app()->easyImage->thumbOf($expert->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                    <span></span>
                    <div class="user-rating-box">
                        <div class="star-3"><b></b></div>
                    </div>
                </div>
                <header class="name"><?php echo $expert->name; ?></header>
                <div class="desc">Специалист методологии</div>
                <div class="price-time"><?php echo sprintf('%0.0f', $expert->consult_price); ?> руб./мин.</div>
            </div>

            <div class="follow"></div>
        </li>

        <?php endforeach; ?>

        <li class="users-item user-plus">

        </li>
    </ul>
</li>

<li class="users-list-box users-list-row-2">
    <header>Новостные порталы<span>Всего (<?php echo count($feeds); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($feeds as $feed) : ?>

            <li class="users-item">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($feed->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><?php echo $feed->name; ?></header>
                    <div class="desc">Новостной <br/> портал</div>
                </div>
                <div class="follow"></div>
            </li>

        <?php endforeach; ?>

    </ul>
</li>

<li class="users-list-box users-list-row-3">
    <header>Люди <span>Всего (<?php echo count($users); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($users as $user) : ?>

            <li class="users-item">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><?php echo $user->name; ?></header>
                    <div class="desc">Пользователь</div>
                </div>
                <div class="follow"></div>
            </li>

        <?php endforeach; ?>

    </ul>
</li>
</ul>
</div>
</div>