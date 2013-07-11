<h3>Выберите дни и время удобное вам для проведения регулярных консультаций:</h3>

<div class="form">
    <?php $form=$this->beginWidget('ActiveForm', array(
        'id'=>'consultSchedule-form',
        'method'=>'post',
        'action'=>$this->createAbsoluteUrl('/expert/default/createSchedule/',array('')),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of ActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <?php #echo $form->errorSummary(); ?>
    <table><tr>
    <?php for ($day=1; $day <= 7; $day++): ?>
        <th>
            <a href="#" onclick="$('.shedule-one-day').hide();$('#shedule-one-day-<?php echo $day; ?>').show();return false;">
                <?php echo strftime('%a', strtotime('Last monday')+($day-1)*86400); ?>
            </a>
        </th>
    <?php endfor ?>
    </tr></table>

    <?php for ($day=1; $day <= 7; $day++): ?>
        <div class="shedule-one-day" id="shedule-one-day-<?php echo $day; ?>"<?php if ($day!=1): ?> style="display:none;"<?php endif; ?>>
            <?php echo $day; ?>
        </div>
    <?php endfor ?>


    <div>
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->