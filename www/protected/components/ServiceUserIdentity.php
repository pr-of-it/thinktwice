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

            // @todo: Поищем сначала такого пользователя в базе
            $user = User::model()->findByAttributes(array(
                'service.service' => $this->service->serviceName,
                'service.service_user_id' => $this->service->id;
            ));
            var_dump($user);die;

            $this->name = $this->service->getAttribute('name');
            $this->setState('id', $this->service->id);
            $this->setState('login', '');
            $this->setState('email', '');
            $this->setState('name', $this->name);
            $this->setState('service', $this->service->serviceName);
            $this->errorCode = self::ERROR_NONE;

        }
        else {
            $this->errorCode = self::ERROR_NOT_AUTHENTICATED;
        }

        return $this->errorCode == self::ERROR_NONE;

    }

}