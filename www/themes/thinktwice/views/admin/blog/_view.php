<?php
/* @var $this BlogController */
/* @var $data Blog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->getTypeLabel($data->type)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

    <?php if (0!=$data->getAttributeLabel('month_price')) : ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('month_price')); ?>:</b>
        <?php echo CHtml::encode($data->month_price); ?>
        <br />
    <?php endif; ?>

    <?php if (0!=$data->getAttributeLabel('week_price')) : ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('week_price')); ?>:</b>
        <?php echo CHtml::encode($data->week_price); ?>
        <br />
    <?php endif; ?>

    <?php if (0!=$data->getAttributeLabel('year_price')) : ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('year_price')); ?>:</b>
        <?php echo CHtml::encode($data->year_price); ?>
        <br />
    <?php endif; ?>


</div>