<?php

class PaymentUnitellerWidget extends CWidget {

    public $acquiring;

    public function init() {
        $this->acquiring->URL_RETURN_OK = Yii::app()->createAbsoluteUrl($this->acquiring->URL_RETURN_OK);
        $this->acquiring->URL_RETURN_NO = Yii::app()->createAbsoluteUrl($this->acquiring->URL_RETURN_NO);
        $this->render('form', array('acquiring' => $this->acquiring));
    }

}