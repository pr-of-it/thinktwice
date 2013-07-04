<h5>Заявка на подключение RSS: </h5>
<?php $form=$this->beginWidget('ActiveForm', array(
    'id'=>'rssrequest-form',
    'action'=>$this->createAbsoluteUrl('/privateblog/rssrequest/'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of ActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($rssRequest); ?>

<div class="row">
    <?php echo $form->labelEx($user->blog,'Блог'); ?>
    <?php echo $form->dropDownList($user->blog,'title', CHtml::listData( Blog::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id)), 'id', 'title' )); ?>
    <?php echo $form->error($user->blog,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($rssRequest,'Тема'); ?>
    <?php echo $form->textField($rssRequest,'title',array('size'=>60,'maxlength'=>255));?>
    <?php echo $form->error($rssRequest,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($rssRequest,'Ссылка'); ?>
    <?php echo $form->textField($rssRequest,'url',array('size'=>50,'maxlength'=>255));?>
    <?php echo $form->error($rssRequest,'url'); ?>
</div>


<div class="row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<?php $this->endWidget(); ?></p>
