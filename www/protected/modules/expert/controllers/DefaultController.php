<?php

class DefaultController extends ExpertController
{
    /*
     * Главная страница интерфейса эксперта
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'status =' . CallRequest::STATUS_ACCEPTED;
        $criteria->order = 'call_time DESC';
        $callRequest = CallRequest::model()->find($criteria);

        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array(
            'user' => $user,
            'callRequest' => $callRequest,
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
            'user' => $user,

        ));
    }

    public function actionConsult() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('consult',array(
            'user' => $user,

        ));
    }

    public function actionConsultSchedule() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render( 'consultschedule',array (
            'user' => $user,
        ));
    }

    public function actionCreateSchedule($consultSchedule) {


        var_dump($consultSchedule);die;

        $this->render( 'consultSchedule',array (
            'user' => $user,
        ));
    }

    public function actionClosest() {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('closest',array(
            'user' => $user
        ));
    }

     public function actionUpdateStatus($id, $status, $call_time)
    {
        $model = CallRequest::model()->findByPk($id);
        $user = User::model()->findByPk($model->caller_id);
        $transaction = new UserTransaction();
        $model->status = $status;
        switch ( $model->status ) {

            case CallRequest::STATUS_REJECTED:
                $model->comments[CallRequest::STATUS_REJECTED] = $_POST['comments'];
                User::model()->findByPk($model->user_id)->sendMessage(
                    'Статус заявки на звонок на thinktwice.ru',
                    'Уважаемый пользователь! Ваша заявка на звонок эксперту отклонена экспертом по причине: ' . $_POST['comments'],
                    array('email','sms')
                );
                break;

            case CallRequest::STATUS_ACCEPTED:
                $model->call_time = $call_time;
                $model->status = CallRequest::STATUS_ACCEPTED;
                if ( $model->save() )
                $this->redirect(array('requests'));

            case CallRequest::STATUS_COMPLETE:
                $amountOff = $model->duration * $user->consult_price;
                $amountOff = -1 * $amountOff;
                $transaction->amount = $amountOff;
                $transaction->user_id = $model->user_id;
                $transaction->reason = 'Списание средств за консультацию у эксперта: ' . $user->name;
                if ( $transaction->save() )
                    $model->status = CallRequest::STATUS_COMPLETE;
                if ( $model->save() )
                    $this->redirect(array('closest'));

        }

        if( $model->save() ) {
            $this->redirect(array('index'));
        } else {
            Yii::app()->user->setFlash('FAIL_WRITE', 'Ошибка записи');
            $this->redirect(array('callrequest', 'id' => $id));
        }
    }

    public function actionCallTransfer($id, $call_time) {
        $model = CallRequest::model()->findByPk($id);
        $model->call_time = $call_time;
        $model->status = CallRequest::STATUS_MODERATED;
        $model->save();
        $this->redirect(array('requests'));

    }

}