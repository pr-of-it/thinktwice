<?php
/* @var $this Controller
 * @var $currentUser User
 * @var $experts User[]
 * @var $feeds User[]
 * @var $users User[]
 */
?>

<?php /* ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(__DIR__.'/users.js')); ?>

<script id="user-template" type="text/html">
    <li class="users-item{{extraClass}}" data-id="{{id}}" data-userrole="{{role}}">
        <div class="user-content">
            <div class="avatar-rating">
                <img src="{{avatar}}" alt="{{name}}">
                <span></span>
                {{#ratingBox}}
                <div class="user-rating-box">
                    <div class="star-3"><b></b></div>
                </div>
                {{/ratingBox}}
            </div>
            <header class="name"><a href="/user/index/{{id}}">{{name}}</a></header>
            <div class="desc">{{{desc}}}</div>
            {{#price}}<div class="price-time"><span>{{price}}</span> руб./мин.</div>{{/price}}
        </div>
        <div class="{{followClass}}"></div>
    </li>
</script>
<?php */ ?>

<div id="container">

<div id="rails" class="page-users">
<ul class="users-list-wrap clear">

<li class="users-list-box users-list-row-3 users-list-following">
    <header>Я подписался <span>Всего (<?php echo count($currentUser->subscripts); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($subscripts as $subscript) : ?>

            <?php if ( $subscript->role->name == 'expert' ) : ?>
            <li class="users-item user-premium" data-id="<?php echo $subscript->id; ?>" data-userrole="<?php echo $subscript->role->name; ?>">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($subscript->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                        <div class="user-rating-box">
                        <div class="star-3"><b></b></div>
                    </div>
                    </div>
                    <header class="name"><a href="<?php echo $this->createAbsoluteUrl('/user/index', array('id' => $subscript->id)); ?>"><?php echo $subscript->name; ?></a></header>
                    <div class="desc">Специалист методологии</div>
                    <div class="price-time"><span><?php echo sprintf('%0.0f', $subscript->consult_price); ?></span> руб./мин.</div>
                </div>
                <div class="unfollow"></div>
            </li>
            <?php else : ?>
                <li class="users-item" data-id="<?php echo $subscript->id; ?>" data-userrole="<?php echo $subscript->role->name; ?>">
                    <div class="user-content">
                        <div class="avatar-rating">
                            <?php echo Yii::app()->easyImage->thumbOf($subscript->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                            <span></span>
                        </div>
                        <header class="name"><a href="<?php echo $this->createAbsoluteUrl('/user/index', array('id' => $subscript->id)); ?>"><?php echo $subscript->name; ?></a></header>
                        <div class="desc">UNI <br/> Дизайнер</div>
                    </div>
                    <div class="unfollow"></div>
                </li>
            <?php endif; ?>

        <?php endforeach; ?>

    </ul>
</li>


<li class="users-list-box users-list-row-3 users-list-experts">
    <header>Эксперты <span>Всего (<?php echo count($experts); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($experts as $expert) : ?>

        <li class="users-item user-premium" data-id="<?php echo $expert->id; ?>" data-userrole="<?php echo $expert->role->name; ?>">
            <div class="user-content">
                <div class="avatar-rating">
                    <?php echo Yii::app()->easyImage->thumbOf($expert->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                    <span></span>
                    <div class="user-rating-box">
                        <div class="star-3"><b></b></div>
                    </div>
                </div>
                <header class="name"><a href="<?php echo $this->createAbsoluteUrl('/user/index', array('id' => $expert->id)); ?>"><?php echo $expert->name; ?></a></header>
                <div class="desc">Специалист методологии</div>
                <div class="price-time"><span><?php echo sprintf('%0.0f', $expert->consult_price); ?></span> руб./мин.</div>
            </div>

            <div class="follow"></div>
        </li>

        <?php endforeach; ?>

        <li class="users-item user-plus">

        </li>
    </ul>
</li>

<?php /* ?>
<li class="users-list-box users-list-row-3 users-list-portals">
    <header>Новостные порталы<span>Всего (<?php echo count($feeds); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($feeds as $feed) : ?>

            <li class="users-item" data-id="<?php echo $feed->id; ?>" data-userrole="<?php echo $feed->role->name; ?>">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($feed->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><a href="<?php echo $this->createAbsoluteUrl('/user/index', array('id' => $feed->id)); ?>"><?php echo $feed->name; ?></a></header>
                    <div class="desc">Новостной <br/> портал</div>
                </div>
                <div class="follow"></div>
            </li>

        <?php endforeach; ?>

    </ul>
</li>

<li class="users-list-box users-list-row-3 users-list-others">
    <header>Люди <span>Всего (<?php echo count($users); ?>)</span></header>
    <ul class="users-list clear">

        <?php foreach ($users as $user) : ?>

            <li class="users-item" data-id="<?php echo $user->id; ?>" data-userrole="<?php echo $user->role->name; ?>">
                <div class="user-content">
                    <div class="avatar-rating">
                        <?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>90), 'crop'=>array('width'=>90, 'height'=>90))); ?>
                        <span></span>
                    </div>
                    <header class="name"><a href="<?php echo $this->createAbsoluteUrl('/user/index', array('id' => $user->id)); ?>"><?php echo $user->name; ?></a></header>
                    <div class="desc">Пользователь</div>
                </div>
                <div class="follow"></div>
            </li>

        <?php endforeach; ?>

    </ul>
</li>

<li class="users-list-box ajax-loader">
    <ul class="users-list clear">
        <li class="ajax-loader-wrap">
            <div>
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/ajax-loader-lenta.gif" alt=""/>
                <span>Возобновить загрузку</span>
            </div>
        </li>
    </ul>
</li>
<?php */ ?>
</ul>

</div>
</div>
<script type="text/javascript">
window.USER = {
    id: "<?php echo $currentUser->id ?>"
}
</script>