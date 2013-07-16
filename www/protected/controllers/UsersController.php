<?php
/**
 * Контроллер страницы пользователей
 */

class UsersController extends Controller {

    public $layout = '//layouts/win8/users';

    public function actionIndex() {
        $this->render('index', array(
            'currentUser' => User::model()->findByPk(Yii::app()->user->id),
        ));
    }

}