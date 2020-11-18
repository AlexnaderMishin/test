<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AdminController extends Controller
{
    public function beforeAction($action){
        
        if(Yii::$app->user->isGuest ){
            return $this->redirect(['site/login']);
         }
        if( Yii::$app->user->identity->admin == 0){
             return $this->redirect(['site/404.php']);
          }
        if(!parent::beforeAction($action)){
            return false;
        }
        return true;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

   
}
