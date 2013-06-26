<?php
class ChangePasswordForm extends CFormModel {

    public $oldPassword, $newPassword, $newPasswordRepeat;

    public function rules()
    {
        return array(
            // username and password are required
            array('oldPassword, newPassword, newPasswordRepeat', 'required'),
            array('newPasswordRepeat', 'compare', 'compareAttribute'=>'newPassword'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'oldPassword' => 'Текущий пароль',
            'newPassword' => 'Новый пароль',
            'newPasswordRepeat' => 'Новый пароль еще раз',
        );
    }

    public function changePassword() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ( User::cryptPassword($this->oldPassword, $user->password) !== $user->password ) {
            $this->addError('oldPassword','Неверный текущий пароль.');
            return false;
        }
        $user->password = $this->newPassword;
        $user->save();
        return true;
    }

}
