<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    protected $_id;

    public $login;

    public $name;

    /**
     * Constructor.
     * @param string $username username
     * @param string $password password
     */
    public function __construct($login,$password)
    {
        $this->login=$login;
        $this->password=$password;
    }

	/**
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $record = User::model()->findByAttributes(array('login'=>$this->login));
        if ( null === $record ) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ( crypt($this->password, $record->password) !== $record->password ) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            $this->setState('id', $record->id);
            $this->setState('login', $record->login);
            $this->setState('email', $record->email);
            $this->setState('name', $record->name);
            $this->setState('service', '');
            $this->setState('service_user_id', '');
            $this->errorCode=self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;

    }

    public function getId() {
        return $this->_id;
    }

    public function getName()
    {
        return $this->login;
    }

}