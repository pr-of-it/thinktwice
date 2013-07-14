<?php

class ExpertController extends Controller
{
    public $layout='//layouts/expert-mobile';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('guest', 'expert', 'admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    protected function beforeAction($action) {

        $token = Yii::app()->request->getQuery('token');

        /**
         * Нам приходится разрешать доступ гостю,
         * чтобы сработала авторизация по токену
         * Но если токена нет - отправим на страницу входа
         */
        if ( Yii::app()->user->isGuest && empty($token) ) {
            $this->redirect($this->createAbsoluteUrl('/site/login'));
        }

        if ( Yii::app()->user->isGuest && !empty($token) ) {

            /*
             * @todo Учитывать все параметры запроса
             */
            Yii::app()->user->returnUrl = Yii::app()->createAbsoluteUrl(
                '/expert/' . Yii::app()->controller->id . '/' . $action->id,
                array(
                )
            );
            $this->redirect($this->createAbsoluteUrl('/site/login', array('token'=>$token)));

        }

        return parent::beforeAction($action);

    }

}