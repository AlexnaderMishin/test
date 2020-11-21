<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Request;
use app\models\RequestSearch;

class LkController extends Controller
{
    public function beforeAction($action){
        
        if(Yii::$app->user->isGuest ){
            return $this->redirect(['site/login']);
         }
        if( Yii::$app->user->identity->admin == 1){
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

    public function actionMyRequests(){
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->searchForUser(Yii::$app->request->queryParams, Yii::$app->user->identity->id);

        return $this->render('my-request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
}
