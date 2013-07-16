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

    /**
     * AJAX
     * Добавляет пользователя с указанным ID в список subscripts текущего
     * @param int $id
     */
    public function actionAjaxFollowUser($id) {

        $model = UserFollower::model()->findByAttributes( array('follower_id' => $id,'user_id' => Yii::app()->user->id));

        if($model == null) {

            $model = new UserFollower;
            $model->attributes = array('follower_id'=>$id, 'user_id'=>Yii::app()->user->id);
            if( $model->save() )
                $ret = true;
            else
                $ret = false;

        } else {
            $ret = false;
        }

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

    /**
     * AJAX
     * Удаляет пользователя с указанным ID из списка subscripts текущего
     * @param int $id
     */
    public function actionAjaxUnfollowUser($id) {

        $model = UserFollower::model()->findByAttributes( array('follower_id' => $id,'user_id' => Yii::app()->user->id));

        if($model != null) {

            if( $model->delete() )
                $ret = true;
            else
                $ret = false;

        } else {
            $ret = false;
        }

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

}