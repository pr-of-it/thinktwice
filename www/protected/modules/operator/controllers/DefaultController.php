<?php

class DefaultController extends OperatorController
{
    public function actionIndex($id)
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array(
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
        if( $model->save() ){
            $this->redirect(array('callrequest','id'=>$id));
        }
    }
}