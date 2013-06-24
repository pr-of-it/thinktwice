<?php

class PrivateController extends Controller {

    public $layout='//layouts/column2';

    public function actionIndex() {

        $user = User::model()->with(array('followers', 'services'))->findByPk(Yii::app()->user->id);
        $this->render('index', array(
            'user' => $user,
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
}
