<?php
namespace frontend\controllers;
use yii\web\Controller;

class TinTucController extends Controller
{
	
	public function actionIndex()
	{
		return $this->render('index');
	}
	public function actionTinTheGioi()
	{
		return $this->render('tin-the-gioi');
	}
}
?>