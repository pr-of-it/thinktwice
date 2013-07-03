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
            array(
                'allow',
                'actions'=>array(
                    'index', 'profile',
                    'services', 'deleteService',
                    'account',
                    'blog',
                    'password',
                    'deposit', 'depositFail', 'depositSuccess','callRequest',
                    'deleteAvatar',
                    'rssRequest',
                    'rss',
                ),
                'roles'=>array('user'),
            ),
            array(
                'allow',
                'actions'=>array(
                    'depositResult'
                ),
                'roles'=>array('guest'),
            ),
            array(
                'deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }


    public function actionIndex() {
        $user = User::model()->with(array('followers', 'services'))->findByPk(Yii::app()->user->id);
        $rss = new BlogRss;
        $rssRequest = new BlogRssRequest;

        $this->render('index', array(
            'user' => $user,
            'rss' => $rss,
            'rssRequest' => $rssRequest,
        ));
    }


    public function actionProfile() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        if(isset($_POST['User']))
        {
            $user->attributes=$_POST['User'];
            if($user->save())
                $this->redirect(array('/private'));
        }

        $this->render('profile', array(
            'user' => $user,
        ));

    }

    public function actionDeleteAvatar($id) {

        $user = User::model()->findByPk($id);
        unlink(Yii::getPathOfAlias('webroot') . $user->avatar_file);
        $user->avatar_file = '';
        $user->save();
        $this->redirect(array('/private/profile'));

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

   public function actionBlog(){

       $blog = Blog::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));

       if(isset($_POST['Blog']))
       {
           $blog->attributes=$_POST['Blog'];
           if($blog->save())
               $this->redirect(array('/private'));
       }
    }


    public function actionRss() {
        $rss = new BlogRss;

        if ( isset($_POST['BlogRss']) ) {
            $rss->attributes = $_POST['BlogRss'];
            if ( $rss->save() )
                $this->redirect(array('/private'));
        }
    }

    public function actionRssRequest() {
        $rss = new BlogRssRequest;

        if ( isset($_POST['BlogRssRequest']) ) {
            $rss->attributes = $_POST['BlogRssRequest'];
            if ( $rss->save() )
                $this->redirect(array('/private'));
        }
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
            echo ActiveForm::validate($model);
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

    public function actionDeposit($amount=null) {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $model = new DepositForm();
        if ( null != $amount ) {
            $model->amount = $amount;
        }
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo ActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['DepositForm']))
        {
            $model->attributes=$_POST['DepositForm'];
            // validate user input and redirect to the previous page if valid
            if( $model->validate() )
                $model->depositPrepare();
        }

        $this->render('deposit', array(
            'user' => $user,
            'model' => $model,
        ));

    }

    public function actionDepositFail() {

        //@todo: Тупая заглушка, обрабатывать это должно расширение эквайера
        $transaction = UserTransactionIncomplete::model()->findByPk(intval($_GET['Order_ID']));

        if ( null == $transaction )
            $this->redirect(array('/private/deposit'));

        $transaction->delete();
        $this->render('depositFail', array('transaction' => $transaction));

    }

    public function actionDepositSuccess() {

        //@todo: Тупая заглушка, обрабатывать это должно расширение эквайера
        $transaction = UserTransactionIncomplete::model()->findByPk(intval($_GET['Order_ID']));

        if ( null == $transaction )
            $this->redirect(array('/private/deposit'));

        $this->render('depositSuccess', array('transaction' => $transaction));

    }

    public function actionDepositResult() {

    }

    public function actionCallRequest($expert_id) {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $expert = User::model()->findByPk($expert_id);

        if ( $user->getAmount() < $expert->consult_price ) {
            $amount = $expert->consult_price - $user->getAmount();

            Yii::app()->user->setFlash("NO_AMOUNT", 'У Вас не хватает средств на счете');

            $this->redirect(array('/private/deposit','amount'=>$amount));
        }else{
            $model = new CallRequest();
            $model->user_id = Yii::app()->user->id;
            $model->caller_id = $expert_id;
            if(isset($_POST['CallRequest']))
            {
                $model->attributes=$_POST['CallRequest'];
                if($model->save()) {
                    $this->redirect(array('site/userPage','id'=>$expert_id));
                }
            }
            Yii::app()->user->setFlash("FORM_REQUEST", 'Заполните пожалуйста форму заказа консультации');
            $this->render('createcallrequest',array(
                'model'=>$model,
            ));

        }
    }

}