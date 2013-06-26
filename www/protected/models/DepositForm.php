<?php

class DepositForm extends CFormModel {

    public $amount;
    public $acquiring;

    public $subform;
    public $acqObject;

    public function rules()
    {
        return array(
            // username and password are required
            array('amount, acquiring', 'required'),
            array('amount', 'numerical'),
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
            'uniteller' => 'Пополнение банковской картой через сервис Uniteller',
        );
    }

    public function depositPrepare() {

        $amount = floatval(str_replace(',', '.', $this->amount));
        if ( $amount <= 0 ) {
            $this->addError('amount','Некорректная сумма.');
            return false;
        }

        $acquirings = $this->getAcquirings();

        $incompleteTransaction = new UserTransactionIncomplete();
        $incompleteTransaction->user_id = Yii::app()->user->id;
        $incompleteTransaction->amount = $amount;
        $incompleteTransaction->reason = $acquirings[$this->acquiring];
        $incompleteTransaction->save();

        $acquiringClass = 'Payment' . ucfirst($this->acquiring);
        $acquiring = Yii::app()->$acquiringClass;

        if ( false !== $acquiring($incompleteTransaction) ) {
            $this->acqObject = $acquiring;
            return true;
        };

        return false;

    }

}