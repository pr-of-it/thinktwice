<?php


class PaymentUniteller extends CApplicationComponent {

    public $mode;
    public $real;
    public $test;

    public $Order_IDP;
    public $Subtotal_P;
    public $Customer_IDP;
    public $Signature;
    public $MeanType;
    public $EMoneyType;
    public $Card_IDP;
    public $IData;
    public $PT_Code;

    public $URL_RETURN_OK;
    public $URL_RETURN_NO;

    public function init() {
        $this->URL_RETURN_OK = 'private/depositSuccess';
        $this->URL_RETURN_NO = 'private/depositFail';
        return parent::init();
    }

    public function __invoke($transaction) {

        $this->Order_IDP = $transaction->id;
        $this->Subtotal_P = sprintf("%0.2f", $transaction->amount);
        $this->Customer_IDP = $transaction->user_id;

        if ( $this->mode == 'real' ) {
            $this->MeanType = 0;
            $this->EMoneyType = 0;
        } else {
            $this->MeanType = '';
            $this->EMoneyType = '';
        }

        $this->Signature = strtoupper(md5(
            md5($this->{$this->mode}['Shop_IDP']) . '&' . md5($this->Order_IDP) . '&' . md5($this->Subtotal_P) . '&' .
            md5($this->MeanType) . '&' . md5($this->EMoneyType) . '&' . md5($this->{$this->mode}['Lifetime']) . '&' .
            md5($this->Customer_IDP) . '&' . md5($this->Card_IDP='') . '&' . md5($this->IData='') . '&' .
            md5($this->PT_Code='') . '&' . md5($this->{$this->mode}['password'])
        ));

        return true;

    }

    public function getSubFormWidget() {
        return __CLASS__ . 'Widget';
    }

}