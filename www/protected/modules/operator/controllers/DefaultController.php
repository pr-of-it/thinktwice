<?php

class DefaultController extends OperatorController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}