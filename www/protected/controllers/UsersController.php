*<?php
/**
 * Контроллер страницы пользователей
 */

class UsersController extends Controller {

    public $layout = '//layouts/win8/users';

    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array('allow', 'users'=>array('@') ),
            array('deny',  'users'=>array('*')),
        );
    }

    public function actionIndex() {

        $currentUser = User::model()->findByPk(Yii::app()->user->id);

        $subscripts = $currentUser->subscripts;
        $subscriptsIds = array();
        foreach ( $subscripts as $subscript )
            $subscriptsIds[] = $subscript->id;
/*
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->offset = 0;
        $criteria->addNotInCondition('id', $subscriptsIds);

        $expertCriteria = clone $criteria;
        $expertCriteria->addCondition('roleid=:roleid');
        $expertRole = UserRole::model()->findByAttributes(array('name' => 'expert'))->id;
        $expertCriteria->params = array_merge($expertCriteria->params, array(':roleid' => $expertRole));
        $expertCriteria->limit = 14;
        $experts = User::model()->findAll($expertCriteria);

        $feedCriteria = clone $criteria;
        $feedCriteria->addCondition('roleid=:roleid');
        $rssRole = UserRole::model()->findByAttributes(array('name' => 'rss'))->id;
        $feedCriteria->params = array_merge($feedCriteria->params, array(':roleid' => $rssRole));
        $feedCriteria->limit = 15;
        $feeds = User::model()->findAll($feedCriteria);

        $usersCriteria = clone $criteria;
        $usersCriteria->addCondition('roleid=:roleid');
        $userRole = UserRole::model()->findByAttributes(array('name' => 'user'))->id;
        $usersCriteria->params = array_merge($usersCriteria->params, array(':roleid' => $userRole));
        $usersCriteria->limit = 25;
        $users = User::model()->findAll($usersCriteria);
*/
        $this->render('index', array(
            'currentUser' => $currentUser,
            'subscripts' => $subscripts,
            //'experts' => $experts,
            //'feeds' => $feeds,
            //'users' => $users,
        ));

    }

    /*
     * ------------------------ AJAX -------------------------------
     */

    public function actionAjaxGetUsers($limit, $offset = 0, $filter = null) {

        $currentUser = User::model()->findByPk(Yii::app()->user->id);

        $subscripts = $currentUser->subscripts;
        $subscriptsIds = array();
        foreach ( $subscripts as $subscript )
            $subscriptsIds[] = $subscript->id;

        $criteria = new CDbCriteria();
        $criteria->order = 't.id DESC';
        $criteria->offset = $offset;
        $criteria->limit = $limit;
        $criteria->select = 't.id, name, role.name';
        $criteria->with = 'role';

        switch ( $filter ) {
            case 'following':
                $criteria->addInCondition('t.id', $subscriptsIds);
                break;
            case 'experts':
                $criteria->addNotInCondition('t.id', $subscriptsIds);
                $criteria->addCondition('role.name=:rolename');
                $criteria->params = array_merge($criteria->params, array(':rolename' => 'expert'));
                break;
            case 'portals':
                $criteria->addNotInCondition('t.id', $subscriptsIds);
                $criteria->addCondition('role.name=:rolename');
                $criteria->params = array_merge($criteria->params, array(':rolename' => 'rss'));
                break;
            case 'others':
                $criteria->addNotInCondition('t.id', $subscriptsIds);
                $criteria->addCondition('role.name=:rolename');
                $criteria->params = array_merge($criteria->params, array(':rolename' => 'user'));
                break;
        }

        $ret = User::model()->findAll($criteria);

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

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