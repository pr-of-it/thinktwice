<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

    <?php
      if ( !$data -> avatar == null ) {
            echo Yii::app()->easyImage->thumbOf($data->avatar, array('resize'=>array('width'=>108, 'height'=>108)));
      } ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_time')); ?>:</b>
	<?php echo CHtml::encode($data->register_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_time')); ?>:</b>
	<?php echo CHtml::encode($data->update_time); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('can_consult')); ?>:</b>
    <?php echo CHtml::encode($data->can_consult); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('consult_price')); ?>:</b>
    <?php echo CHtml::encode($data->consult_price); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('followers')); ?>:</b>
    <?php
    $followers = array();
    foreach ( $data->followers as $follower ):
	    $followers[] = CHtml::link(CHtml::encode($follower->name), array('view', 'id'=>$follower->id));
    endforeach; ?>
    <?php echo implode('|', $followers); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
    <?php $this->widget('ext.StarWidget.StarWidget', array('rating'=>$data->rating)); ?>
    <br />



    <h1>comments</h1>

    <?php $this->renderPartial('comment.views.comment.commentList', array(
        'model'=>$data
    )); ?>

</div>