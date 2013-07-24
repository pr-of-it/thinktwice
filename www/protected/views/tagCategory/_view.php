<?php
/* @var $this TagCategoryController */
/* @var $data TagCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('left')); ?>:</b>
	<?php echo CHtml::encode($data->left); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('right')); ?>:</b>
	<?php echo CHtml::encode($data->right); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />


</div>