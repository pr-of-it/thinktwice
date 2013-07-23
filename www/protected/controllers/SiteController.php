<?php

class SiteController extends Controller
{
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
        if ( isset ($_POST['BlogPost']['id']) ) {
            $post = BlogPost::model()->findByPk($_POST['BlogPost']['id']);
        } else {
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

        // РЕГИСТРАЦИЯ

        // Создаем форму регистрации
        // Предзаполняем ей поля "код инвайта" и "email", если они переданы в ссылке
        $registerForm = new RegisterForm();
        $registerForm->invite_code = $code ?: null;
        $registerForm->email = $email ?: null;

        // Пробуем зарегистрировать пользователя через социальную сеть
        $service = Yii::app()->request->getQuery('service');
        if ( !empty($service) ) {
            $this->subRegisterByService($service, $registerForm->email, $registerForm->invite_code);
        }

        // Если заполнена форма регистрации - пытаемся зарегистрировать пользователя
        if(isset($_POST['RegisterForm']))
        {
            $registerForm->attributes=$_POST['RegisterForm'];
            if( $registerForm->validate() && $registerForm->register() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        // ВХОД НА САЙТ

        // Создаем форму входа на сайт
        $loginForm = new LoginForm;

        // Пытаемся авторизоваться по сервису социальной сети
        $service = Yii::app()->request->getQuery('service');
        if ( !empty($service) )
            $this->subLoginByService($service);

        // Пытаемся авторизоваться по токену
        /*
         * Закомментировано, поскольку не предусмотрено здесь
        $token = Yii::app()->request->getQuery('token');
        if ( !empty($token) ) {
            $this->subLoginByToken($token);
        }
        */

        // Если форма уже заполнена - пытаемся авторизовать пользователя по данным из формы
        if(isset($_POST['LoginForm']))
        {
            $loginForm->attributes=$_POST['LoginForm'];
            if( $loginForm->validate() && $loginForm->login() )
                $this->redirect(Yii::app()->user->returnUrl);
        }

        // РЕНДЕР

        // Отображаем формы
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

        // Создаем форму регистрации
        // Предзаполняем ей поля "код инвайта" и "email", если они переданы в ссылке
        $registerForm = new RegisterForm();
        $registerForm->invite_code = $code ?: null;
        $registerForm->email = $email ?: null;

        // Если заполнена форма регистрации - пытаемся зарегистрировать пользователя
        if(isset($_POST['RegisterForm']))
        {
            $registerForm->attributes=$_POST['RegisterForm'];
            if( $registerForm->validate() && $registerForm->register() ) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('register',array('model'=>$registerForm));

    }

    /**
     * Вход на сайт
     */
    public function actionLogin()
    {

        // Создаем форму входа на сайт
        $loginForm = new LoginForm;

        // Пытаемся авторизоваться по сервису социальной сети
        $service = Yii::app()->request->getQuery('service');
        if ( !empty($service) )
            $this->subLoginByService($service);

        // Пытаемся авторизоваться по токену
        $token = Yii::app()->request->getQuery('token');
        if ( !empty($token) ) {
            $this->subLoginByToken($token);
        }

        // Если форма уже заполнена - пытаемся авторизовать пользователя по данным из формы
        if(isset($_POST['LoginForm']))
        {
            $loginForm->attributes=$_POST['LoginForm'];
            if( $loginForm->validate() && $loginForm->login() )
                $this->redirect(Yii::app()->user->returnUrl);
        }

        $this->render('login',array('model'=>$loginForm));

    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }


    /**
     * Восстановление забытого пароля пользователя
     */
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


    /**
     * Процедура авторизации по токену
     * @param $token
     * @param string $cancelUrl
     */
    protected function subLoginByToken($token, $cancelUrl='site/enter') {

        $identity = new TokenUserIdentity($token);

        if ( $identity->authenticate() ) {
            Yii::app()->user->login($identity, 3600*24*30);
            // @todo На dev-сайте не работает ->user->returnUrl, поэтому такое кривое решение
            $this->redirect(Yii::app()->request->getQuery('returnUrl'));
        } else {
            $this->redirect($this->createAbsoluteUrl($cancelUrl));
        }

    }

    /**
     * Процедура авторизации через социальную сеть
     * @param $service
     * @param string $cancelUrl
     */
    protected function subLoginByService($service, $cancelUrl='site/enter') {

        $authIdentity = Yii::app()->eauth->getIdentity($service);
        $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
        $authIdentity->cancelUrl = $this->createAbsoluteUrl($cancelUrl);

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
        } else {
            $this->redirect($this->createAbsoluteUrl($cancelUrl));
        }

    }

    /**
     * Процедура регистрации с использованием локальной сети
     * @param $service
     * @param $email
     * @param null $code
     * @param string $cancelUrl
     */
    protected function subRegisterByService($service, $email, $code=null, $cancelUrl='site/enter') {

        $authIdentity = Yii::app()->eauth->getIdentity($service);
        $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
        $authIdentity->cancelUrl = $this->createAbsoluteUrl($cancelUrl);

        if ($authIdentity->authenticate()) {

            $identity = new ServiceUserIdentity($authIdentity);

            // Успешный вход
            if ($identity->register($email, $code)) {
                Yii::app()->user->login($identity, 3600*24*30);
                // Специальный редирект с закрытием popup окна
                $authIdentity->redirect();
            }
            else {
                // Закрываем popup окно и перенаправляем на cancelUrl
                $authIdentity->cancel();
            }
        } else {
            $this->redirect($this->createAbsoluteUrl($cancelUrl));
        }

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
