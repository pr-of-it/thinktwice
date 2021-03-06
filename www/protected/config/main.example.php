<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(

    'basePath'=>realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'),
    'name'=>'ThinkTwice',
    'theme' => 'thinktwice',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(

        'application.models.*',
        'application.components.*',

        'ext.lightopenid.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',

        'ext.eauth.*',
        'ext.eauth.services.*',

        'ext.paymentUniteller.*',

        'ext.easyimage.EasyImage',

    ),

    'modules'=>array(

        'admin' => array(),

        'operator' => array(),

        'expert' => array(),

        'moderator' => array(),

        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'gii',
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
        'comment'=>array(
            'class'=>'ext.comment-module.CommentModule',
            'commentableModels'=>array(
                // define commentable Models here (key is an alias that must be lower case, value is the model class name)
                'user'=>'User'
            ),
            // set this to the class name of the model that represents your users
            'userModelClass'=>'User',
            // set this to the username attribute of User model class
            'userNameAttribute'=>'name',
            // set this to the email attribute of User model class
            'userEmailAttribute'=>'email',
            // you can set controller filters that will be added to the comment controller {@see CController::filters()}
//          'controllerFilters'=>array(),
            // you can set accessRules that will be added to the comment controller {@see CController::accessRules()}
//          'controllerAccessRules'=>array(),
            // you can extend comment class and use your extended one, set path alias here
//          'commentModelClass'=>'comment.models.Comment',
        ),
    ),

    // application components
    'components'=>array(
        'user'=>array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        'authManager'=>array(
            'class'=>'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'rules'=> include(__DIR__ . DIRECTORY_SEPARATOR . 'route.php'),
        ),
        'db'=>array(
            'connectionString' => 'pgsql:host=localhost;port=5432;dbname=tt',
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',

        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

        'loid' => array(
            'class' => 'application.extensions.lightopenid.loid',
        ),

        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'services' => array( // You can change the providers and their classes.
                'facebook' => array(
                    'class' => 'FacebookOAuthService',
                    'client_id' => '391290324321632',
                    'client_secret' => '62e1b00024612a3a385ad34c4296a4c5',
                ),
            )
        ),

        'easyImage' => array(
            'class' => 'application.extensions.easyimage.EasyImage',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
            ),
        ),

        'PaymentUniteller' => array(
            'class' => 'ext.paymentUniteller.PaymentUniteller',
            'mode' => 'test',
            'real' => array(
                'Shop_IDP' => '00001754',
                'password' => 'lAJ4LFUkEiWHu2ycOTAVoNfAloEhVgaRp9Fch8HRFjqQpl0DY1P8uz19EXVrKUyq0k8sdXCTq2gOJYEV',
                'Lifetime' => '3600',
            ),
            'test' => array(
                'Shop_IDP' => '1957',
                'password' => 'rQuIEh5uMtyOOGDzEu8cc8mnw5FnkfTFMQIXNUXJO5A02GptaH4EhneIUBhhZQ7RqcYyZtSb0bY19Z6Q',
                'Lifetime' => '3600',
            ),
        ),

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'webmaster@example.com',
    ),

);