<?php
/* @var $data User */
class StarWidget extends CWidget {

    public $rating;

    public $cssFile;

    public function init() {

        if($this->cssFile===null)
        {
            $file=dirname(__FILE__).DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'star.css';
            $this->cssFile=Yii::app()->getAssetManager()->publish($file);
            $cs=Yii::app()->clientScript;
            $cs->registerCssFile($this->cssFile);
        }

        $percent = round($this->rating*20);
        $this->render('stars', array('percent' => $percent));

   }



}