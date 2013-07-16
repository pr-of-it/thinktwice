<?php
/**
 * Контроллер страницы пользователей
 */

class UsersController extends Controller {

    public $layout = '//layouts/win8/users';

    public function actionIndex() {
        $expertRole = UserRole::model()->findByAttributes(array('name' => 'expert'));
        $rssRole = UserRole::model()->findByAttributes(array('name' => 'rss'));
        $userRole = UserRole::model()->findByAttributes(array('name' => 'user'));
        $this->render('index', array(
            'currentUser' => User::model()->findByPk(Yii::app()->user->id),
            'experts' => User::model()->findAllByAttributes( array('roleid' => $expertRole->id) ),
            'feeds' => User::model()->findAllByAttributes( array('roleid' => $rssRole->id) ),
            'users' => User::model()->findAllByAttributes( array('roleid' => $userRole->id) ),
        ));
    }

    /*
     * ------------------------ AJAX -------------------------------
     */

    public function actionAjaxFollowUser($id) {

        $model = UserFollower::model()->findByAttributes( array('follower_id' => $follower_id,'user_id' => Yii::app()->user->id));

        if($model != null)
            $this->redirect(array('/user/index','id'=>$follower_id));

        $model = new UserFollower;
        $model->attributes = array('follower_id'=>$follower_id, 'user_id'=>Yii::app()->user->id);
        if( $model->save() )
            $this->redirect(array('/user/index','id'=>$follower_id));

    }

}