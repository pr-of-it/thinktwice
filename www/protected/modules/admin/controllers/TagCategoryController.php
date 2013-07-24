<?php

class TagCategoryController extends AdminController
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
		$model=new TagCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TagCategory']))
		{
            $model->name = $_POST['TagCategory']['name'];

            if ( 0 == $_POST['parent'] ) {
                $result = $model->saveNode();
            } else {
                $parent = TagCategory::model()->findByPk($_POST['parent']);
                if ( $parent )
                    $result = $model->appendTo($parent);
                else
                    $result = $parent;
            }
			if( $result )
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
		// $this->performAjaxValidation($model);

		if(isset($_POST['TagCategory']))
    {

        $model->name = $_POST['TagCategory']['name'];

        if ( 0 == $_POST['parent'] ) {
            $result = $model->saveNode();
        } else {
            $parent = TagCategory::model()->findByPk($_POST['parent']);
            if ( $parent )
                $result = $model->moveAsFirst($parent);
            else
                $result = $parent;
            }
        if( $result )
            $this->redirect(array('view','id'=>$model->id));
    }

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('TagCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TagCategory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TagCategory']))
			$model->attributes=$_GET['TagCategory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TagCategory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TagCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TagCategory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tag-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
