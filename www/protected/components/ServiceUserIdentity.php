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
    protected $service;

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
/*
            var_dump($this->service);
            echo '<hr />';
            var_dump($serviceUser);die;
*/
            if ( null == $serviceUser ) {
                $this->errorCode = self::ERROR_USERNAME_INVALID;
            } else {
                $this->_id = $serviceUser->user->id;
                $this->login = $serviceUser->user->login;
                $this->name = $serviceUser->user->name;
                $this->setState('id', $serviceUser->user->id);
                $this->setState('login', $serviceUser->user->login);
                $this->setState('email', $serviceUser->user->email);
                $this->setState('name', $serviceUser->user->name);
                $this->setState('service', $this->service->serviceName);
                $this->setState('service_user_id', $serviceUser->service_user_id);
                $this->errorCode = self::ERROR_NONE;
            }

        }
        else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

        return $this->errorCode == self::ERROR_NONE;

    }

}