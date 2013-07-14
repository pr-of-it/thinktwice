<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    /**
     * Авторизация по токену
     */
    public function init() {

        $token = Yii::app()->request->getQuery('token');

        if ( !empty($token) && Yii::app()->controller->id != 'site' ) {

            if ( !Yii::app()->user->isGuest ) {
                Yii::app()->user->logout();
            }

            $uri = Yii::app()->request->requestUri;

            $uri = preg_replace("/(token\=" . $token . "[\&]?)/", "", $uri);
            $uri = preg_replace("/[\&]?$/", "", $uri);
            $uri = preg_replace("/\/token\/" . $token . "/", "", $uri);

            Yii::app()->user->returnUrl = $uri;

            $this->redirect($this->createAbsoluteUrl('/site/login', array('token'=>$token)));

        }

    }

}