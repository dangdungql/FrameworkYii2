<?php

namespace backend\controllers;

use Yii;
use backend\models\Book;
use backend\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
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

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->file=UploadedFile::getinstance($model,'file');
            if($model->file){
                $model->file->saveAs('../../uploads/'.$model->file->name);
                $model->image=$model->file->name;
            }
            $model->created_at=time();
            $model->updated_at=time();
            if($model->save(false)){
                Yii::$app->session->addFlash('success','Thêm mới thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->addFlash('danger','Thêm mới không thành công');
                return $this->render('create', [
                'model' => $model,
                ]);
            }
            
        }
        else {
        return $this->render('create', [
            'model' => $model,
        ]);}
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new Book();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->updated_at=time();
            if($model->save()){
                Yii::$app->session->addFlash('success','Update thành công');
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->addFlash('danger','Update không thành công');
                return $this->render('create', [
                'model' => $model,
                ]);
            }
            
        } else {
        return $this->render('update', [
            'model' => $model,
        ]);}
    }

    /**
     * Deletes an existing Book model.
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
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
