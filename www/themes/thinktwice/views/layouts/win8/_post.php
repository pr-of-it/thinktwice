<div class="create-post opacity-hide">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'blog-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'class' => 'create-post-content',
        ),
    )); ?>
        <header>
            <p><?php echo $form->errorSummary($model); ?></p>
            <input placeholder="Тема моего совета" type="text" name=""/>
            <ul class="controlls-fonts">
                <li class="set_font-bold">b</li>
                <li class="set_font-italic">i</li>
                <li class="set_font-link">link</li>
                <li class="set_font-fullscreen">на весь экран</li>
            </ul>
        </header>
        <div class="text-field" contenteditable="true">
            Я понимаю, что на iMac'е рисовать интерфейс клёво и крупные блоки в нём смотрятся отлично, но нужно
            ориентироваться и на экраны поменьше. А на экране поменьше более 2-х рядов блоков не помещается.
            Сделайте компактную плитку.
        </div>
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
                        <select name="">
                            <option value="">Название моей подписки</option>
                            <option value="">Выбор 1</option>
                            <option value="">Выбор 2</option>
                        </select>
                    </td>
                    <td class="width-select-2">
                        <select name="">
                            <option value="">для всех</option>
                            <option value="">Выбор 1</option>
                            <option value="">Выбор 2</option>
                        </select>
                    </td>
                    <td>
                        <input class="button-yellow" type="submit" value="Опубликовать" />
                    </td>
                </tr>
            </table>
        </footer>
    <?php $this->endWidget(); ?>
</div>