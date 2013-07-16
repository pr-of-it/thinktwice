<h1>Пользователи</h1>
<?php foreach ( $user as $u ) : ?>
    <?php echo Yii::app()->easyImage->thumbOf($u->avatar,
        array('resize'=>array('width'=>70), 'crop'=>array('width'=>70, 'height'=>70))); ?><span></span>

        <?php echo $u->name; ?>


<?php endforeach ?>