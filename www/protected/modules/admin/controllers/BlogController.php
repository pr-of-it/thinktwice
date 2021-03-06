<?php

class BlogController extends AdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Blog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
        if ( isset( $_POST['time']) && isset($_POST['price']) ) {
            switch ( $_POST['time'] ) {
                case 'month_price':
                    $model->month_price = $_POST['price'];
                    $model->week_price = 0;
                    $model->year_price = 0;
                    break;
                case 'week_price':
                    $model->week_price = $_POST['price'];
                    $model->month_price = 0;
                    $model->year_price = 0;
                    break;
                case 'year_price':
                    $model->year_price = $_POST['price'];
                    $model->month_price = 0;
                    $model->week_price = 0;
                    break;
            }
        }
		if(isset($_POST['Blog']))
		{
			$model->attributes=$_POST['Blog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this        ->performAjaxValidation($model);
        if ( isset( $_POST['time']) && isset($_POST['price']) ) {
            switch ( $_POST['time'] ) {
                case 'month_price':
                    $model->month_price = $_POST['price'];
                    $model->week_price = 0;
                    $model->year_price = 0;
                    break;
                case 'week_price':
                    $model->week_price = $_POST['price'];
                    $model->month_price = 0;
                    $model->year_price = 0;
                    break;
                case 'year_price':
                    $model->year_price = $_POST['price'];
                    $model->month_price = 0;
                    $model->week_price = 0;
                    break;
            }
        }		if(isset($_POST['Blog']))
		{
			$model->attributes=$_POST['Blog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionBlog($id) {

        $blog = Blog::model()->findByPk($id);
        if( $blog === null )
            throw new CHttpException( 404,'Блог не найден' );

        $dataProvider = new CArrayDataProvider('BlogPost', array(
            'criteria' => array(
                'condition' => 'blog_id=:blog_id',
                'params' => array(':blog_id' => $blog->id),
                'with' => array('blog'),
            ),
            'sort' => array(
                'defaultOrder' => 'time DESC',
            ),
        ));

        $this->render( 'blog',array (
            'blog' => $blog,
            'provider' => $dataProvider,
        ));

    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Blog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Blog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Blog']))
			$model->attributes=$_GET['Blog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Blog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Blog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Blog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-form')
		{
			echo ActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
