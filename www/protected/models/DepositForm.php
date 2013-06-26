<?php

class DepositForm extends CFormModel {

    public $amount;
    public $acquiring;

    public function rules()
    {
        return array(
            // username and password are required
            array('amount, acquiring', 'required'),
        );
    }


    public function attributeLabels()
    {
        return array(
            'amount'=>'Amount',
            'acquiring'=>'Acquiring',
        );
    }

    public function getAcquirings() {
        return array(
            'uniteller' => 'Пополнение банковской картой',
        );
    }

}