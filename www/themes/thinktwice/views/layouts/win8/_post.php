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
            <!--<ul class="controlls-fonts">
                <li class="set_font-bold">b</li>
                <li class="set_font-italic">i</li>
                <li class="set_font-link">link</li>
                <li class="set_font-fullscreen">на весь экран</li>
            </ul>-->
        </header>
        <div class="wysiwyg-text-field">
            <?php echo $form->textArea($model,'text', array('id'=>'post-editor')); ?>
             <?php echo $form->error($model,'text'); ?>
        </div>
        <div class="tag-attach-box">
            <input placeholder="Теги" type="text" name=""/>
            <ul class="attach-list">
                <!--<li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                <li><img src="<?php echo Yii::app()->request->baseUrl; ?>/win8/img/tmp/city.png" alt=""/></li>
                --><li class="add-attach"></li>
                <?php $this->widget('ext.EFineUploader.EFineUploader', array(
                    'id'=>'FineUploader',
                    'config' => array(
                        'autoUpload'=>true,
                        'request' => array(
                            'endpoint' => $this->createUrl('blog/uploadImage'),
                            'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                        ),
                        'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                        'chunking'=>array('enable'=>true,'partSize'=>100),
                        'callbacks'=>array(
                            'onComplete'=>"js:function(id, name, response){
                                $('li.qq-upload-success').remove();
                                $('#BlogPost_image').val('/upload/blogs/' + response.filename);
                            }",
                            //'onError'=>"js:function(id, name, errorReason){ }",
                        ),
                        'validation'=>array(
                            'allowedExtensions'=>array('jpg','jpeg'),
                            'sizeLimit' => 2 * 1024 * 1024,//maximum file size in bytes
                            //'minSizeLimit'=>2*1024*1024,// minimum file size in bytes
                        ),
                        /*'messages'=>array(
                                          'tooManyItemsError'=>'Too many items error',
                                          'typeError'=>"Файл {file} имеет неверное расширение. Разрешены файлы только с расширениями: {extensions}.",
                                          'sizeError'=>"Размер файла {file} велик, максимальный размер {sizeLimit}.",
                                          'minSizeError'=>"Размер файла {file} мал, минимальный размер {minSizeLimit}.",
                                          'emptyError'=>"{file} is empty, please select files again without it.",
                                          'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                         ),*/
                    )
                )); ?>
                <?php echo $form->hiddenField($model,'image'); ?>
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