<?php

class DefaultController extends ExpertController
{
    /*
     * Главная страница интерфейса эксперта
     */
    public function actionIndex()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array(
            'user' => $user
        ));
    }

    /*
     * Изменение стоимости консультации экспертом
     */
    public function actionPrice() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        if(isset($_POST['User']))
        {
            $user->attributes=$_POST['User'];
            if($user->save())
                $this->redirect(array('index'));
        }

        $this->render('price',array(
            'user' => $user
        ));

    }

    /*
     * Статистика эксперта
     */
    public function actionStat() {

        $user = User::model()->findByPk(Yii::app()->user->id);

        $this->render('stat',array(
            'user' => $user
        ));

    }

    public function actionRequests() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('requests',array(
            'user' => $user
        ));
    }

    public function actionCallRequest($id)
    {
        $callRequest = CallRequest::model()->findByPk($id);
        $this->render( 'callRequest',array (
            'callRequest' => $callRequest,
        ));
    }

    public function actionUpdateStatus($id, $status)
    {
        $model = CallRequest::model()->findByPk($id);
        $model->status = $status;

        switch ( $model->status ) {
            case CallRequest::STATUS_REJECTED:
                $model->comments[CallRequest::STATUS_REJECTED] = $_POST['CallRequest']['comments'];

                User::model()->findByPk($model->user_id)->sendMessage(
                    'Статус заявки на звонок на thinktwice.ru',
                    'Уважаемый пользователь! Ваша заявка на звонок эксперту отклонена экспертом по причине: ' . $model->comments[CallRequest::STATUS_REJECTED],
                    array('email','sms')
                );
                break;
        }

        if( $model->save() ) {
            $this->redirect(array('index'));
        } else {
            Yii::app()->user->setFlash('FAIL_WRITE', 'Ошибка записи');
            $this->redirect(array('callrequest', 'id' => $id));
        }
    }
}