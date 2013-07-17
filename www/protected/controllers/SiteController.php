<?php

class SiteController extends Controller
{

    const LAST_POST = 20;

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view',),
                'users'=>array('*'),
            )
        );
    }

    /**
     * Устанавливаем layout страницы
     * @param $action
     * @return bool
     */
    public function beforeAction($action) {

        if ( false !== strpos(Yii::app()->user->returnUrl, 'expert') ) {
            $this->layout = 'expert-mobile';
            return parent::beforeAction($action);
        };

        if ( Yii::app()->user->isGuest ) {
            $this->layout = '//layouts/win8/page-guest';
        } else {
            $this->layout = '//layouts/win8/page';
        }

        return parent::beforeAction($action);
    }

    /*
     * ------------------------ ГЛАВНАЯ СТРАНИЦА ------------------------
     */

    /**
     * Главная страница сайта
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        // Публикация поста в блог с главной и редактирование его
        if ( isset ($_POST['BlogPost']['id']) )
        {
            $post = BlogPost::model()->findByPk($_POST['BlogPost']['id']);
        }
            else
            {
                $post = new BlogPost();
            }
        if(isset($_POST['BlogPost'])) {
            $media = isset($_POST['BlogPost']['images']) ? $_POST['BlogPost']['images'] : array();
            unset($_POST['BlogPost']['images']);
            $post->attributes=$_POST['BlogPost'];
            if($post->save()) {
                foreach ( $media as $file ) {
                    $model = new BlogPostMedia();
                    $model->post_id = $post->id;
                    $model->url = $file;
                    $model->type = 'image';
                    $model->save();
                }
                $this->redirect(array('/site/index'));
            }
        }

        if ( Yii::app()->user->isGuest ) {
            $user = new stdClass();
            $user->avatar = Yii::app()->baseUrl . User::AVATAR_UPLOAD_PATH . 'empty.jpg';
            $this->layout = '//layouts/win8/index-guest';
        } else {
            $user = User::model()->with('blog')->findByPk(Yii::app()->user->id);
            $this->layout = '//layouts/win8/index';
        }

        $this->render('index',array (
            'post' => $post,
            'user' => $user,
        ));

    }

    /*
     * ------------------------ РЕГИСТРАЦИЯ, ВХОД И ВЫХОД ------------------------
     */


    /**
     * Вход на сайт
     * Возможна регистрация по инвайту или вход для зарегистрированных пользователей
     *
     * @param string $code
     * @param string $email
     */
    public function actionEnter($code = null, $email = null) {

        // Часть регистрации

        $registerForm = new RegisterForm();
        $registerForm->invite_code = $code ?: null;
        $registerForm->email = $email ?: null;

        if(isset($_POST['RegisterForm']))
        {
            $registerForm->attributes=$_POST['RegisterForm'];
            if( $registerForm->validate() && $registerForm->register() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        // Часть входа на сайт

        $service = Yii::app()->request->getQuery('service');

        if (isset($service)) {

            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('site/enter');

	    $isAuth = $authIdentity->authenticate();
	    Yii::log(
		    'authIdentity: ' . $isAuth,
		    CLogger::LEVEL_ERROR, 'application.extentions.eauth'
	    );
            if ($isAuth) {

                $identity = new ServiceUserIdentity($authIdentity);

                // Успешный вход
                if ($identity->authenticate()) {
                    Yii::app()->user->login($identity, 3600*24*30);
                    // Специальный редирект с закрытием popup окна
                    $authIdentity->redirect();
                }
                else {
                    // Закрываем popup окно и перенаправляем на cancelUrl
                    $authIdentity->cancel();
                }
            }

            // Что-то пошло не так, перенаправляем на страницу входа
            $this->redirect(array('site/login'));
        }

        $loginForm = new LoginForm;

        // collect user input datac
        if(isset($_POST['LoginForm']))
        {
            $loginForm->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if( $loginForm->validate() && $loginForm->login() )
                $this->redirect(Yii::app()->user->returnUrl);
        }


        $this->render('enter', array(
            'registerForm' => $registerForm,
            'loginForm' => $loginForm,
        ));

    }

    /**
     * Регистрация на сайте
     * @param string $code Код инвайта
     * @param string $email E-mail
     */
    public function actionRegister($code = null, $email = null) {

        $model = new RegisterForm();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo ActiveForm::validate($model);
            Yii::app()->end();
        }

        $model->invite_code = $code ?: null;
        $model->email = $email ?: null;
        // collect user input data
        if(isset($_POST['RegisterForm']))
        {
            $model->attributes=$_POST['RegisterForm'];
            // validate user input and redirect to the previous page if valid
            if( $model->validate() && $model->register() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        // display the login form
        $this->render('register',array('model'=>$model));

    }

    /**
     * Авторизация на сайте
     */
    public function actionLogin()
    {

        /*
         * Авторизация по сервису социальной сети
         */
        $service = Yii::app()->request->getQuery('service');

        if (isset($service)) {

            $authIdentity = Yii::app()->eauth->getIdentity($service);
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl('site/login');

            if ($authIdentity->authenticate()) {

                $identity = new ServiceUserIdentity($authIdentity);

                // Успешный вход
                if ($identity->authenticate()) {
                    Yii::app()->user->login($identity, 3600*24*30);
                    // Специальный редирект с закрытием popup окна
                    $authIdentity->redirect();
                }
                else {
                    // Закрываем popup окно и перенаправляем на cancelUrl
                    $authIdentity->cancel();
                }
            }

            // Что-то пошло не так, перенаправляем на страницу входа
            $this->redirect(array('site/login'));
        }

        /*
         * Авторизация по токену
         */

        $token = Yii::app()->request->getQuery('token');

        if ( isset($token) ) {

            $identity = new TokenUserIdentity($token);

            if ( $identity->authenticate() ) {
                Yii::app()->user->login($identity, 3600*24*30);
                // @todo На dev-сайте не работает ->user->returnUrl, поэтому такое кривое решение
                $this->redirect(Yii::app()->request->getQuery('returnUrl'));
            } else {
                $this->redirect($this->createAbsoluteUrl('/site/login'));
            }

        }

        /*
         * Авторизация через форму
         */

        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo ActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input datac
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionRestore() {

        $model = new RestoreForm();
        if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
        {
            echo ActiveForm::validate($model);
            Yii::app()->end();
        }
        $success = false;

        if(isset($_POST['RestoreForm'])) {
            $model->attributes=$_POST['RestoreForm'];
            // validate user input and redirect to the previous page if valid
            if( $model->validate() && $model->restore() ) {
                $success = true;
            }
        }

        $this->render('restore',array('model'=>$model, 'success'=>$success));

    }


    /*
     * СТАНДАРТНЫЕ ЭКШНЫ
     */

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }



}
