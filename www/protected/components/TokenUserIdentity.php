<?php

class TokenUserIdentity extends UserIdentity {

    const ERROR_TOKEN_INVALID = 20;
    const ERROR_TOKEN_EXPIRES = 21;

    public $token;

    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $record = User::model()->findByAttributes(array(
            'auth_token'=>$this->token
        ));

        if ( null === $record ) {

            $this->errorCode = self::ERROR_TOKEN_INVALID;

        } elseif ( time() > strtotime($record->auth_token_expire) ) {

            $this->errorCode=self::ERROR_TOKEN_EXPIRES;

        } else {

            $this->_id = $record->id;
            $this->setState('id', $record->id);
            $this->setState('email', $record->email);
            $this->setState('name', $record->name);
            $this->setState('service', '');
            $this->setState('service_user_id', '');
            $this->setState('role', $record->role->name);
            $this->errorCode=self::ERROR_NONE;
        }

        return $this->errorCode == self::ERROR_NONE;

    }

}
