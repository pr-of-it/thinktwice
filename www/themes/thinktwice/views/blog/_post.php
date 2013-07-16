<?php
/* @var $this BlogController */
/* @var $model BlogPost */
/* @var $form ActiveForm */
?>

<?php
$user = $model->blog->user;
$form = $this->beginWidget('ActiveForm', array(
    'id'=>'blog-edit-form',
    'enableAjaxValidation'=>false,
    'method' => 'post',
    'htmlOptions' => array(
        'class' => 'scroll',
    ),
)); ?>

    <header class="popup-head">Редактировать совет</header>

    <?php echo $form->hiddenField($model,'id'); ?>

    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'title-field','id'=>'BlogPost_title_edit')); ?>
    <?php echo $form->error($model,'title'); ?>

    <div class="wysiwyg-text-field">
        <?php echo $form->textArea($model,'text', array('id'=>'popup-post-editor')); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>
    <div class="tag-attach-box">
        <?php echo $form->textField($model,'time'); ?>
        <input placeholder="Теги" type="text" name="">
        
    </div>
    <footer>
        <table>
            <tr>
                <!--<td><a class="add-element" href=""><span></span></a></td>-->
                <td class="width-select-1">

                    <?php echo $form->dropDownList($model, 'blog_id', CHtml::listData($user->getAllBlogs(), 'id', 'title'), array('id'=>'BlogPost_blog_id_edit')); ?>
                    <?php echo $form->error($model,'blog_id'); ?>

                </td>
                <td class="width-select-2">
                    <select name="">
                        <option value="">для всех</option>
                        <option value="">Выбор 1</option>
                        <option value="">Выбор 2</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td class="line-buttons" colspan="3">
                    <a class="button-cancel" href="">Отменить</a>
                    <?php echo CHtml::submitButton('Опубликовать изменения', array('class'=>'button-yellow')); ?>
                </td>
            </tr>
        </table>
    </footer>

<?php $this->endWidget(); ?>
