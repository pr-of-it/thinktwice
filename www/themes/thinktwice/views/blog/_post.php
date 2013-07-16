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

    <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'title-field')); ?>
    <?php echo $form->error($model,'title'); ?>

    <div class="wysiwyg-text-field">
        <?php echo $form->textArea($model,'text', array('id'=>'popup-post-editor')); ?>
        <?php echo $form->error($model,'text'); ?>
    </div>
    <div class="tag-attach-box">
        <input placeholder="Теги" type="text" name="">
        <div class="file-upload-container">
            <ul class="attach-list">
            </ul>
            <?php $this->widget('ext.EFineUploader.EFineUploader', array(
                'id'=>'FineUploader_Edit',
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
                                    var imageInput = $('<input class=\"hidden\" name=\"BlogPost[images][]\" value=\"/upload/blogs/' + response.filename + '\" />');
                                    $('.window-post .file-upload-container').append(imageInput);
                                    $('#blog-edit-form .attach-list').append('<li><img src=\"/upload/blogs/' + response.filename + '\"></li>')
                                }",
                        //'onError'=>"js:function(id, name, errorReason){ }",
                    ),
                    'validation'=>array(
                        'allowedExtensions'=>array('jpg','jpeg','png','gif'),
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
            <?php //echo $form->hiddenField($model,'image'); ?>
        </div>
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
