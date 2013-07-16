<?php
/**
 * Контроллер страницы пользователей
 */

class UsersController extends Controller {

    public $layout = '//layouts/win8/users';

    public function actionIndex() {
        $expertRole = UserRole::model()->findByAttributes(array('name' => 'expert'));
        $rssRole = UserRole::model()->findByAttributes(array('name' => 'rss'));
        $this->render('index', array(
            'currentUser' => User::model()->findByPk(Yii::app()->user->id),
            'experts' => User::model()->findAllByAttributes( array('roleid' => $expertRole->id) ),
            'feeds' => User::model()->findAllByAttributes( array('roleid' => $rssRole->id) ),
        ));
    }

}