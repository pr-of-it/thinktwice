<p style="margin:20px 0;">Выберите дни и время удобное вам для проведения регулярных консультаций</p>
<div class="diagram">
    <table width="100%" class="one-line">
        <tr>
            <?php for ($day=1; $day <= 7; $day++): ?>
                <td><span>
                    <a href="#" onclick="$('.shedule-one-day').hide();$('#shedule-one-day-<?php echo $day; ?>').show();return false;">
                        <?php echo strftime('%a', strtotime('Last monday')+($day-1)*86400); ?>
                    </a>
                </span></td>
            <?php endfor ?>
        </tr>
    </table
    <div class="form">
        <?php $form=$this->beginWidget('ActiveForm', array(
            'id'=>'consultSchedule-form',
            'method'=>'post',
            'action'=>$this->createAbsoluteUrl('/expert/default/createSchedule/',array('id'=> $user->id)),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of ActiveForm for details on this.
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
            <?php $hours = array ('10:00 - 12:00', '12:00 - 14:00', '14:00 - 16:00', '16:00 - 18:00', '18:00 - 20:00', '20:00 - 22:00'); ?>
                <?php for ( $day=1; $day <= 7; $day++ ): ?>
                   <div class="shedule-one-day" id="shedule-one-day-<?php echo $day; ?>"<?php if ($day!=1): ?> style="display:none;"<?php endif; ?>>
                       <?php foreach ( $hours as $h ) :?>
                           <div class="clearfix">
                               <label class="block bg-light-green">
                                   <?php echo $h?>
                                   <span></span>
                                   <input
                                       type="checkbox"
                                       name="WorkTime[<?php echo $day; ?>][]"
                                       value="<?php echo $h; ?>"
                                       <?php if (isset($user->consultSchedule->$day) && in_array($h, $user->consultSchedule->$day)) : ?>
                                           checked="checked"<?php endif; ?>
                                       />
                               </label>
                           </div>
                         <?php endforeach?>
                   </div>
                <?php endfor?>
        <div>
            <?php echo CHtml::submitButton('Сохранить', array(
                'class'=>'but but-yellow',
            )); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
