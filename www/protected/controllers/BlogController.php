<?php

class BlogController extends Controller {

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('*',),
                'users'=>array('@'),
            )
        );
    }

    public function actionIndex($id) {

        $blog = Blog::model()->findByPk($id);
        if( $blog === null )
            throw new CHttpException( 404,'Блог не найден' );

        $criteria=new CDbCriteria(array(
            'condition' => 'blog_id=' . $blog->id,
            'order' => 'time DESC',
            'with' => 'blog',
        ));

        $dataProvider=new CActiveDataProvider('BlogPost', array(
            'pagination'=>array(
                'pageSize'=>5,
            ),
            'criteria'=>$criteria,
        ));

        $pages = new CPagination($dataProvider->getCountCriteria());
        $this->render('blog',array (
            'blog' => $blog,
            'dataProvider' => $dataProvider,
            'pages' => $pages,
        ));

    }

    // AJAX actions

    public function actionGetIndexBlogPosts($limit, $offset=0) {
        $criteria = new CDbCriteria(array(
            'order' => 'time DESC',
            'with' => 'blog',
            'limit' => $limit,
            'offset' => $offset,
        ));
        $posts = BlogPost::model()->findAll($criteria);
        echo CJSON::encode($posts);
        Yii::app()->end();
    }

    public function actionGetIndexBlogPost($id) {
        $post = BlogPost::model()->with('blog')->findByPk($id);
        echo CJSON::encode($post);
        Yii::app()->end();
    }


}