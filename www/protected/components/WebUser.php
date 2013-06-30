<?php

class WebUser extends CWebUser {

    public $allowAutoLogin=true;

    public function init() {
        parent::init();
        if ( !isset($this->role) ) {
            $this->setState('role', 'guest');
        }
    }

    public function logout($destroySession=true) {
        parent::logout(false);
        $this->setState('role', 'guest');
    }

}