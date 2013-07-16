<?php
/* @var $this Controller
 * @var $currentUser User
 * @var $experts User[]
 * @var $feeds User[]
 */
?>
<div id="container">

<div id="rails" class="page-users">
<ul class="users-list-wrap clear">

<li class="users-list-box users-list-row-2">
    <header>Я подписался <span>Всего (<?php echo count($currentUser->followers); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($currentUser->followers as $follower) : ?>

            <?php if ( $follower->role->name == 'expert' ) : ?>
            <li class="users-item user-premium">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($follower->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><?php echo $follower->name; ?></header>
                    <div class="desc">Специалист методологии</div>
                    <div class="price-time"><?php echo sprintf('%0.0f', $follower->consult_price); ?> руб./мин.</div>
                </div>
                <div class="close"></div>
            </li>
            <?php else : ?>
                <li class="users-item">
                    <div class="user-content">
                        <div class="avatar-rating">
                            <?php echo Yii::app()->easyImage->thumbOf($follower->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                            <span></span>
                        </div>
                        <header class="name"><?php echo $follower->name; ?></header>
                        <div class="desc">UNI <br/> Дизайнер</div>
                    </div>
                    <div class="close"></div>
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

            <div class="close"></div>
        </li>

        <?php endforeach; ?>

        <li class="users-item user-plus">

        </li>
    </ul>
</li>

<li class="users-list-box users-list-row-2">
    <header>Новостные порталы</header>
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
                <div class="close"></div>
            </li>

        <?php endforeach; ?>

    </ul>
</li>

<li class="users-list-box users-list-row-3">
    <header>Люди <span>Всего (1689)</span></header>
    <ul class="users-list clear">
        <li class="users-item user-premium">
            <div class="user-content">
                <div class="avatar-rating">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/users/img/tmp/image-float.png" alt=""/>
                    <span></span>
                </div>
                <header class="name">Лиза Карицина</header>
                <div class="desc">Специалист методологии</div>
                <div class="price-time">2 500 руб./мин.</div>
            </div>

            <div class="close"></div>
        </li>
        <li class="users-item user-premium">
            <div class="user-content">
                <div class="avatar-rating">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/users/img/tmp/image-float.png" alt=""/>
                    <span></span>
                </div>
                <header class="name">Даниил Октопов</header>
                <div class="desc">Разработки и внедрение систем</div>
                <div class="price-time">2 500 руб./мин.</div>
            </div>
            <div class="close"></div>
        </li>
        <li class="users-item">
            <div class="user-content">
                <div class="avatar-rating">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/users/img/tmp/image-float.png" alt=""/>
                    <span></span>
                </div>
                <header class="name">Игорь Белявский</header>
                <div class="desc">UNI <br/> Дизайнер</div>
            </div>
            <div class="close"></div>
        </li>
        <li class="users-item user-premium">
            <div class="user-content">
                <div class="avatar-rating">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/users/img/tmp/image-float.png" alt=""/>
                    <span></span>
                </div>
                <header class="name">Лиза Карицина</header>
                <div class="desc">Специалист методологии</div>
                <div class="price-time">2 500 руб./мин.</div>
            </div>

            <div class="close"></div>
        </li>
        <li class="users-item user-premium">
            <div class="user-content">
                <div class="avatar-rating">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/users/img/tmp/image-float.png" alt=""/>
                    <span></span>
                </div>
                <header class="name">Даниил Октопов</header>
                <div class="desc">Разработки и внедрение систем</div>
                <div class="price-time">2 500 руб./мин.</div>
            </div>
            <div class="close"></div>
        </li>
    </ul>
</li>
</ul>
</div>
</div>