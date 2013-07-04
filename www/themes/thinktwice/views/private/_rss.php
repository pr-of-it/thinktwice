<h5>Добавить RSS ленту</h5>
<?php $form=$this->beginWidget('ActiveForm', array(
    'id'=>'rss-form',
    'action'=>$this->createAbsoluteUrl('/privateblog/rss/'),
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of ActiveForm for details on this.
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<?php echo $form->errorSummary($rss); ?>


<div class="row">
    <?php echo $form->labelEx($rss,'Тема'); ?>
    <?php echo $form->textField($rss,'title',array('size'=>60,'maxlength'=>255));?>
    <?php echo $form->error($rss,'title'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($rss,'Ссылка'); ?>
    <?php echo $form->textField($rss,'url',array('size'=>60,'maxlength'=>255));?>
    <?php echo $form->error($rss,'url'); ?>
</div>

<?php echo $form->hiddenField($rss, 'blog_id', array('value'=>$user->blog->id)) ?>

<div class="row">
    <?php echo CHtml::submitButton('Сохранить'); ?>
</div>

<?php $this->endWidget(); ?></p>




