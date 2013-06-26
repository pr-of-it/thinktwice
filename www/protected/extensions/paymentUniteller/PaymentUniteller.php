<?php


class PaymentUniteller extends CApplicationComponent {

    public $Shop_IDP;
    public $Order_IDP;
    public $Subtotal_P;
    public $Lifetime;
    public $Customer_IDP;
    public $Signature;
    public $MeanType;
    public $EMoneyType;
    public $Card_IDP;
    public $IData;
    public $PT_Code;

    public $URL_RETURN_OK;
    public $URL_RETURN_NO;

    public $password;

    public function init() {
        $this->URL_RETURN_OK = 'private/depositSuccess';
        $this->URL_RETURN_NO = 'private/depositFail';
        return parent::init();
    }

    public function __invoke($transaction) {

        $this->Order_IDP = $transaction->id;
        $this->Subtotal_P = sprintf("%0.2f", $transaction->amount);
        $this->Customer_IDP = $transaction->user_id;

        $this->Signature = strtoupper(md5(
            md5($this->Shop_IDP) . '&' . md5($this->Order_IDP) . '&' . md5($this->Subtotal_P) . '&' .
            md5($this->MeanType=0) . '&' . md5($this->EMoneyType=0) . '&' . md5($this->Lifetime) . '&' .
            md5($this->Customer_IDP) . '&' . md5($this->Card_IDP='') . '&' . md5($this->IData='') . '&' .
            md5($this->PT_Code='') . '&' . md5($this->password)
        ));

        return true;

    }

    public function getSubFormWidget() {
        return __CLASS__ . 'Widget';
    }

}