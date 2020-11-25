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
use app\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;


class LkController extends Controller
{

     /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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
        // return $this->render('index');
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->searchForUser(Yii::$app->request->queryParams, Yii::$app->user->identity->id);

        return $this->render('my-request', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreate()
    {
        
        $model = new Request();
        //Если уже заполнили и отправили форму Т.е в POST что то есть
        if(Yii::$app->request->isPost){
            //ПОлучаем файл из соответсвующег аттрибута формы модели
            //С помощью спец. класса из фреймворка
            $model->photoBefore = UploadedFile::getInstance($model, 'photoBefore');
            
           
            $allow = ['png' , 'jpg'];
            $ext = strtolower($model->photoBefore->extension);
            if(!in_array($ext, $allow))
            {
                    //Если форму только открыли и ещё не загружали
                    	
                    Yii::$app->session->setFlash('danger', "Только png или jpg");
                    $categories = Category::find()->orderBy('name')->all();
                    $categories = ArrayHelper::map($categories, 'id', 'name');

                    return $this->render('create', [
                        'model' => $model,
                        'categories' => $categories,
        ]);
            }
            //В переменную сохраняем название файла вместе с расширением
            $fileName = md5(time()).'.'.$ext;
            // Здесь же можно написать валидацию загрузки файла
            //Сохранение файла в папку
            $model->photoBefore->saveAs('@app/web/upload/' . $fileName);
            // Загружаем все значения модели которые были указаны в фомре
            $model->attributes = \Yii::$app->request->post('Request');
            // Явно указываем название файла
            $model->photoBefore = $fileName;
            // Получаем пользователя
            $model->idUser = Yii::$app->user->identity->id;
            // сохраняем в бд
            $model->save();
            // Если сохранилось перебрасываем на ЛК
            return $this->redirect(['index']);
        }

        
        //Если форму только открыли и ещё не загружали
        $categories = Category::find()->orderBy('name')->all();
        $categories = ArrayHelper::map($categories, 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }
     
    
}
