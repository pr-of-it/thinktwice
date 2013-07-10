<?php
/*
 * @var $this DefaultController
 * @var $user User
 */

$this->breadcrumbs=array(
    'Интерфейс эксперта'
);
?>

<div id="user-info" class="clearfix">
    <span class="ava"><?php echo Yii::app()->easyImage->thumbOf($user->avatar, array('resize'=>array('width'=>108), 'crop'=>array('width'=>108, 'height'=>108))); ?></span>
    <h1 style="margin:6px 0;"><?php echo $user->name; ?></h1>
    <h2><?php echo sprintf('%0.2f', $user->amount); ?>&nbsp;руб.</h2>
</div>

<div class="block bg-red">Ближайшая консультация: <b style="margin:8px 0;"><?php echo $callRequest ? $callRequest->call_time : 'Нет'; ?></b></div>
<a href="<?php echo $this->createUrl('requests'); ?>" title="" class="block bg-green">Ожидают подтверждения:<span class="count f-r"><?php echo count($user->getExpertCallRequests()); ?></span></a>
<a href="<?php echo $this->createUrl('closest'); ?>" title="" class="block bg-green">Ближайшие консультации:<span class="count f-r"><?php echo count($user->getExpertClosest()); ?></span></a>
<a href="<?php echo $this->createUrl('consultgrath'); ?>" title="" class="block bg-green">График консультаций:<span class="count f-r">**</span></a>
<a href="<?php echo $this->createUrl('price'); ?>" title="" class="block bg-green">Стоимость моих консультаций: <?php echo sprintf('%0.2f', $user->consult_price); ?>&nbsp;руб.</a>
<a href="<?php echo $this->createUrl('stat'); ?>" title="" class="block bg-green">Статистика:</a>