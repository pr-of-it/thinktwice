<?php

/**
 * Страницы, связанные с пользователями сайта
 * Class UserController
 */

class UserController extends Controller {

    /*
     * ------------------- СЛУЖЕБНЫЕ МЕТОДЫ ------------------------
     */


    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index',),
                'users'=>array('*'),
            ),
            array('allow',
                'actions' => array('ajaxChangePhone', 'ajaxRequestPhoneVerify', 'ajaxVerifyPhoneCode'),
                'users' => array('@'),
            )
        );
    }

    /**
     * Устанавливаем layout страницы
     * @param $action
     * @return bool
     */
    public function beforeAction($action) {

        if ( Yii::app()->user->isGuest ) {
            $this->layout = '//layouts/win8/page-guest';
        } else {
            $this->layout = '//layouts/win8/page';
        }

        return parent::beforeAction($action);
    }

    /*
     * ------------------- /СЛУЖЕБНЫЕ МЕТОДЫ ------------------------
     */


    /**
     * Личная страница пользователя
     * @param $id ID пользователя
     * @throws CHttpException
     */
    public function actionIndex($id) {

        $user = User::model()->findByPk($id);
        if( $user === null )
            throw new CHttpException( 404,'Страница пользователя не найдена' );

        $currentUser = User::model()->findByPk(Yii::app()->user->id);
        $model = new CallRequest();

        /*
         * @todo Сделать это по-нормальному в форме
         */
        if ( $model->isNewRecord ) {
            $model->duration = 15;
            $model->call_time           = date('Y-m-d H:i:s', strtotime('today') + 15*60*60);
            $model->alter_call_time_1   = date('Y-m-d H:i:s', strtotime('tomorrow') + 15*60*60);
            $model->alter_call_time_2   = date('Y-m-d H:i:s', strtotime('sunday') + 15*60*60);
        }


        if ( isset($_POST['CallRequest']) ) {

            $model->attributes=$_POST['CallRequest'];
            $model->user_id = $currentUser->id;
            $model->caller_id = $user->id;

            if ( $model->validate() ) {

                $sum = $_POST['CallRequest']['duration'] * $user->consult_price;

                if ( $currentUser->getAmount() < $sum ) {

                    $amount = $sum - $currentUser->getAmount();
                    Yii::app()->user->setFlash("NO_AMOUNT", 'У Вас не хватает средств на счете');
                    $this->redirect(array('/private/deposit', 'amount'=>$amount));

                }

                if($model->save()) {
                    $this->redirect(array('/user/index','id'=>$user->id));
                }

            }

        }

        $this->render('index',array (
            'user' => $user,
            'currentUser' => $currentUser,
            'model'=>$model,
        ));

    }

    /**
     * Добавление в фолловеры
     * @param $follower_id
     */
    public function actionAddFollower($follower_id) {

        $model = UserFollower::model()->findByAttributes( array('follower_id' => $follower_id,'user_id' => Yii::app()->user->id));

        if($model != null)
            $this->redirect(array('/user/index','id'=>$follower_id));

        $model = new UserFollower;
        $model->attributes = array('follower_id'=>$follower_id, 'user_id'=>Yii::app()->user->id);
        if( $model->save() )
            $this->redirect(array('/user/index','id'=>$follower_id));

    }

    /**
     * Удаление из фолловеров
     * @param $follower_id
     */
    public function actionDelFollower($follower_id) {
        $model = UserFollower::model()->findByAttributes(array('follower_id'=>$follower_id,'user_id'=>Yii::app()->user->id));
        if($model->delete())
            $this->redirect(array('/user/index','id'=>$follower_id));
    }

    /**
     * AJAX
     * Получение списка пользователей
     * @param int $limit
     * @param int $offset
     */
    public function actionAjaxGetUsersList($limit, $offset=0) {

        $criteria = new CDbCriteria(array(
            'select' => 'id, email, name, phone, active, can_consult, consult_price, avatar_file',
            'order' => 't.id DESC',
            'with' => 'role',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $users = User::model()->findAll($criteria);

        header('Content-type: application/json');
        echo CJSON::encode($users);
        Yii::app()->end();
    }

    /**
     * AJAX
     * Изменение телефонного номера у текущего пользователя
     * Возвращает код верификации
     * @param $phone
     */
    public function actionAjaxChangePhone($phone) {

        $user = User::model()->findByPk(Yii::app()->user->id);

        $user->phone = $phone;
        $user->phone_verified = 0;
        $user->save();

        $ret = new stdClass();
        $ret->code = $user->doPhoneVerify();

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

    /**
     * AJAX
     * Запрос верификации телефонного номера у текущего пользователя
     * Возвращает код верификации
     * @param $phone
     */
    public function actionAjaxRequestPhoneVerify($phone) {

        $user = User::model()->findByPk(Yii::app()->user->id);

        $user->phone = $phone;
        $user->phone_verified = 0;
        $user->save();

        $ret = new stdClass();
        $ret->code = $user->doPhoneVerify();

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

    /**
     * AJAX
     * Проверка кода верификации номера телефона текущего пользователя
     * @param $code
     */
    public function actionAjaxVerifyPhoneCode($code) {

        $user = User::model()->findByPk(Yii::app()->user->id);
        $ret = $user->verifyPhoneCode($code);

        header('Content-type: application/json');
        echo CJSON::encode($ret);
        Yii::app()->end();

    }

}