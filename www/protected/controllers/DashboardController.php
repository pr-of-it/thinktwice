<?php
class DashboardController extends Controller {
    public $layout = '//layouts/win8/dashboard';

    public function actionIndex() {

        $this->render('index', array(
            'currentUser' => User::model()->findByPk(Yii::app()->user->id),
        ));
    }

    public function actionAjaxSetCookieCloseVideo() {
        if ( !Yii::app()->user->isGuest ) {
            Yii::app()->request->cookies['notShowVideo'] = new CHttpCookie('notShowVideo', 1);
        }
        Yii::app()->end();
    }
}