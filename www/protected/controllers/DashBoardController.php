<?php
class DashBoardController extends Controller {
    public $layout = '//layouts/win8/dashboard';

    public function actionIndex() {
        $this->render('index', array(
            'currentUser' => User::model()->findByPk(Yii::app()->user->id),
        ));
    }
}