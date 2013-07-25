<?php

class PrivateBlogController extends Controller {

    public function actionBlog(){
        $blog = Blog::model()->findByAttributes(
            array('user_id' => Yii::app()->user->id,
                  'type' => Blog::SIMPLE_BLOG,
        ));
            if(isset($_POST['Blog']))
            {
                $blog->attributes = $_POST['Blog'];
                if($blog->save())
                    $this->redirect(array('/private'));
            }
        }


    public function actionRss() {
        $rss = new BlogRss;
        if ( isset( $_POST['BlogRss'] ) ) {
            $rss->attributes = $_POST['BlogRss'];
            if ( $rss->save() )
                $this->redirect(array('/private'));
        }
    }

    public function actionRssRequest() {
        $rss = new BlogRssRequest;
        if ( isset( $_POST['Blog'] ) ) {
            $rss->blog_id = $_POST['Blog']['title'];
        }
        if ( isset( $_POST['BlogRssRequest'] ) ) {
            $rss->attributes = $_POST['BlogRssRequest'];
            if ( $rss->save() )
                $this->redirect(array('/private'));
        }
    }

    public function actionSubscript() {
            if ( isset ($_POST['Blog']) && $_POST['Blog']['id'] != 0 ) {
                $subscript = Blog::model()->findByPk($_POST['Blog']['id']);
            }
            else {
                $subscript = new Blog;
                $subscript->user_id = Yii::app()->user->id;
                $subscript->type = Blog::SUBSCRIPT_BLOG;
            }
            if ( isset( $_POST['time']) && isset($_POST['price']) ) {
                switch ( $_POST['time'] ) {
                    case 'month_price':
                        $subscript->month_price = $_POST['price'];
                        $subscript->week_price = 0;
                        $subscript->year_price = 0;
                        break;
                    case 'week_price':
                        $subscript->week_price = $_POST['price'];
                        $subscript->month_price = 0;
                        $subscript->year_price = 0;
                        break;
                    case 'year_price':
                        $subscript->year_price = $_POST['price'];
                        $subscript->month_price = 0;
                        $subscript->week_price = 0;
                        break;
                }
            }


            $subscript->attributes = $_POST['Blog'];
                if ( $subscript->save())
                    $this->redirect(array('/private'));
    }
}