<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $login;
	public $password;
	public $password_repeat;
    public $email;
    public $invite_code;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('login, password, password_repeat, email, invite_code', 'required'),
            array('password_repeat', 'compare', 'compareAttribute'=>'password'),
        );
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function register()
	{

        $invite = Invite::model()->find('email=:email', array(':email'=>$this->email));
        if ( null === $invite ) {
            $this->addError('email','No invite for this email.');
            return false;
        }

        if ( $invite->code != $this->invite_code ) {
            $this->addError('invite_code','Invalid invite code.');
            return false;
        }

        try {

            $user = new User();
            $user->login = $this->login;
            $user->password = $this->password;
            $user->email = $this->email;
            $user->save();

            $this->_identity=new UserIdentity($this->login,$this->password);
            $this->_identity->authenticate();
            $duration= 3600*24*30; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;

        } catch ( CDbException $e ) {
            $this->addError('login','Incorrect login or email.');
            return false;
        }
	}
}
