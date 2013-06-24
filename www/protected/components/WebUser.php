<?php

class WebUser extends CWebUser {

    public function logout($destroySession=true) {
        parent::logout(false);
        $this->setState('role', 'guest');
    }

}