<?php

class BlogController extends Controller {

    public $layout = '//layouts/win8/index';

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

        $this->render('index',array (
            'blog' => $blog,
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * AJAX
     * Возвращает последние посты для ленты
     * @param int $limit
     * @param int $offset
     */
    public function actionGetIndexBlogPosts($limit, $offset=0) {

        $criteria = new CDbCriteria(array(
            'order' => 'time DESC',
            'with' => 'blog',
            'limit' => $limit,
            'offset' => $offset,
        ));

        $posts = BlogPost::model()->with('blog', 'blog.user', 'media')->findAll($criteria);

        header('Content-type: application/json');
        echo CJSON::encode($posts);
        Yii::app()->end();

    }

    public function actionGetIndexBlogPost($id) {
        $post = BlogPost::model()->with('blog', 'blog.user', 'media')->findByPk($id);
        header('Content-type: application/json');
        echo CJSON::encode($post);
        Yii::app()->end();
    }

    /**
     * AJAX
     * Выдача формы редактирования поста в блоге
     * @param $id ID записи поста
     */
    public function actionAjaxGetPostEditForm($id) {
        $model = BlogPost::model()->findByPk($id);
        $this->renderPartial('_post', array('model' => $model));
        Yii::app()->end();
    }

    /**
     * AJAX
     * Загрузка изображения к посту
     */
    public function actionUploadImage() {

        $tempFolder=Yii::getPathOfAlias('webroot').'/upload/blogs/';
        $webFolder = Yii::app()->getBaseUrl() . '/upload/blogs/';

        @mkdir($tempFolder, 0777, TRUE);
        @mkdir($tempFolder.'chunks', 0777, TRUE);

        Yii::import("ext.EFineUploader.qqFileUploader");

        $uploader = new qqFileUploader();
        $uploader->allowedExtensions = array('jpg','jpeg');
        $uploader->sizeLimit = 2 * 1024 * 1024;//maximum file size in bytes
        $uploader->chunksFolder = $tempFolder.'chunks';

        $result = $uploader->handleUpload($tempFolder);
        $result['filename'] = $uploader->getUploadName();
        $result['folder'] = $webFolder;

        $uploadedFile=$tempFolder.$result['filename'];

        header("Content-Type: text/plain");
        $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        echo $result;
        Yii::app()->end();

    }

}