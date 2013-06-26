<?php

class PrivateController extends Controller {

    public $layout='//layouts/column2';

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
                'actions'=>array('index','services', 'deleteService','account', 'password', 'deposit'),
                'roles'=>array('user'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex() {

        $user = User::model()->with(array('followers', 'services'))->findByPk(Yii::app()->user->id);
        $this->render('index', array(
            'user' => $user,
        ));
    }
    public function actionAccount(){
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array('user_id' => Yii::app()->user->id));
        $count=UserTransaction::model()->count($criteria);
        $pages=new CPagination($count);
        // элементов на страницу
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $criteria->order = 'id DESC';
        $models = UserTransaction::model()->findAll($criteria);
        $this->render('account', array(
            'models' => $models,
            'pages' => $pages
        ));
    }


    public function actionServices($service = null) {

        $user = User::model()->with(array('services'))->findByPk(Yii::app()->user->id);

        if ( !is_null($service) ) {

            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = $this->createAbsoluteUrl('private/services');
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('private/services');

            if ($authIdentity->authenticate()) {

                $identity = new ServiceUserIdentity($authIdentity);

                if ( empty($user->services) ) {
                    $service = new UserService();
                    $service->user_id = $user->id;
                    $service->service = $identity->service->getServiceName();
                    $service->service_user_id = $identity->service->id;
                    $service->service_user_name = $identity->service->name;
                    $service->save();
                }

                // Специальный редирект с закрытием popup окна
                $authIdentity->redirect();

            }

            // Что-то пошло не так, перенаправляем на страницу отмены
            $this->redirect($authIdentity->cancel());
        }

        $this->render('services', array(
            'user' => $user,
        ));

    }

    public function actionDeleteService($id) {
        $service = UserService::model()->findByPk($id);
        $service->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('private/services'));
    }

    public function actionPassword() {
        $model = new ChangePasswordForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if(isset($_POST['ChangePasswordForm']))
        {
            $model->attributes=$_POST['ChangePasswordForm'];
            // validate user input and redirect to the previous page if valid
            if( $model->validate() && $model->changePassword() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        $this->render('password',array('model'=>$model));
    }

    public function actionDeposit() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $model = new DepositForm();
        $this->render('deposit', array(
            'user' => $user,
            'model' => $model,
        ));
    }

}
