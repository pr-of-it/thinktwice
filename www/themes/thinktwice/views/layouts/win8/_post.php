<?php
/* @var $this SiteController */
/* @var $user User */
/* @var $model BlogPost */
/* @var $form ActiveForm */
?>
<div class="create-post opacity-hide">

    <?php $form = $this->beginWidget('ActiveForm', array(
        'id'=>'blog-form',
        'enableAjaxValidation'=>false,
        'method' => 'post',
        'htmlOptions' => array(
            'class' => 'create-post-content',
        ),
    )); ?>

        <header>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'placeholder'=>'Тема моего совета')); ?>
            <?php echo $form->error($model,'title'); ?>
            <ul class="controlls-fonts">
                <li class="set_font-bold">b</li>
                <li class="set_font-italic">i</li>
                <li class="set_font-link">link</li>
                <li class="set_font-fullscreen">на весь экран</li>
            </ul>
        </header>
        <?php echo $form->textArea($model,'text',array('class'=>'text-field')); ?>
        <?php echo $form->error($model,'text'); ?>
        <div class="tag-attach-box">
            <input placeholder="Теги" type="text" name=""/>
            <ul class="attach-list">
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                <li class="add-attach"></li>
            </ul>
        </div>
        <footer>
            <table>
                <tr>
                    <!--<td><a class="add-element" href=""><span></span></a></td>-->
                    <td class="width-select-1">
                        <?php echo $form->dropDownList($model, 'blog_id', CHtml::listData($user->getAllBlogs(), 'id', 'title')); ?>
                        <?php echo $form->error($model,'blog_id'); ?>
                    </td>
                    <td class="width-select-2">
                        <select name="">
                            <option value="">для всех</option>
                            <option value="">Выбор 1</option>
                            <option value="">Выбор 2</option>
                        </select>
                    </td>
                    <td>
                        <?php echo CHtml::submitButton('Опубликовать', array('class'=>'button-yellow')); ?>
                    </td>
                </tr>
            </table>
        </footer>

    <?php $this->endWidget(); ?>

</div>