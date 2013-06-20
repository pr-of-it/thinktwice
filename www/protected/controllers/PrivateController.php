<?php

class PrivateController extends Controller {

    public $layout='//layouts/column2';

    public function actionIndex() {
        $user = User::model()->with(array('followers', 'services'))->findByPk(Yii::app()->user->id);
        $this->render('index', array(
            'user' => $user
        ));
    }
}
