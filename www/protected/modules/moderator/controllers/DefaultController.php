<?php

class DefaultController extends ModeratorController {

public function actionIndex()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array(
            'user' => $user
        ));
    }


public function actionSuccessRssRequest ($id)
        {
        $rssRequest = BlogRssRequest::model()->findByPk($id);
        $blogRss = new BlogRss();
        $blogRss->blog_id = $rssRequest->blog_id;
        $blogRss->title = $rssRequest->title;
        $blogRss->url = $rssRequest->url;
        if($blogRss->save());
            $rssRequest->delete();
        $this->redirect(array('/moderator'));
        }

public function actionFailureRssRequest ($id)
        {
        $rssRequest = BlogRssRequest::model()->findByPk($id);
        $rssRequest->delete();
            $this->redirect(array('/moderator'));
        }
}