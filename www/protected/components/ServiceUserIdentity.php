<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class ServiceUserIdentity extends UserIdentity {

    /**
     * @var EAuthServiceBase the authorization service instance.
     */
    public $service;

    /**
     * Constructor.
     * @param EAuthServiceBase $service the authorization service instance.
     */
    public function __construct($service) {
        $this->service = $service;
    }

    /**
     * Authenticates a user based on {@link username}.
     * This method is required by {@link IUserIdentity}.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

        if ($this->service->isAuthenticated) {

            // Поищем сначала такого пользователя в базе, авторизованного через сервис
            $serviceUser = UserService::model()->with('user')->findByAttributes(array(
                'service' => $this->service->serviceName,
                'service_user_id' => $this->service->id,
            ));

            if ( null == $serviceUser ) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } else {
                $this->_id = $serviceUser->user->id;
                $this->email = $serviceUser->user->email;
                $this->name = $serviceUser->user->name;
                $this->setState('id', $serviceUser->user->id);
                $this->setState('email', $serviceUser->user->email);
                $this->setState('name', $serviceUser->user->name);
                $this->setState('service', $this->service->serviceName);
                $this->setState('service_user_id', $serviceUser->service_user_id);
                $this->setState('role', $serviceUser->user->role->name);
                $this->errorCode = self::ERROR_NONE;
            }

        }
        else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

        return $this->errorCode == self::ERROR_NONE;

    }

    public function register($email, $code) {

        if ($this->service->isAuthenticated) {

            $invite = Invite::model()->findByAttributes(array('email'=>$email, 'code'=>$code));
            if ( is_null($invite) ) {
                $this->errorCode = self::ERROR_INVITE_INVALID;
            } else {
                $user = new User();
                $user->email = $email;
                $user->name = $this->service->name;
                if ( $user->save() ) {

                    $this->_id = $user->id;
                    $this->email = $user->email;
                    $this->name = $user->name;
                    $this->setState('id', $user->id);
                    $this->setState('email', $user->email);
                    $this->setState('name', $user->name);
                    $this->setState('service', $this->service->serviceName);
                    $this->setState('service_user_id', $serviceUser->service_user_id);
                    $this->setState('role', $user->role->name);
                    $this->errorCode = self::ERROR_NONE;

                } else {
                    $this->errorCode = self::ERROR_EMAIL_INVALID;
                }
            }

            return $this->errorCode == self::ERROR_NONE;

        }

    }

}