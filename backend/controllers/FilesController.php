<?php

namespace backend\controllers;

use Yii;
use common\models\Files;
use backend\models\search\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use backend\models\Model;

/**
 * FilesController implements the CRUD actions for Files model.
 */
class FilesController extends Controller
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
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Files model.
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
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelsOptionValue = [new Files];
        if (Yii::$app->request->post()) {
            $modelsOptionValue = \backend\models\Model::createMultiple(Files::className());

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($modelsOptionValue);
            }

            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());
            foreach ($modelsOptionValue as $index => $modelOptionValue) {
                $db_path = '/files/'.date('Y').'/'.date('m').'/'.date('d');
                $modelOptionValue->file_name = UploadedFile::getInstance($modelOptionValue, "[{$index}]file_name");
                $modelOptionValue->upload($db_path);
                $modelOptionValue->save(false);
            }
            return $this->redirect(['/files']);
        }

        return $this->render('create', [
            'modelsOptionValue' => (empty($modelsOptionValue)) ? [new Files] : $modelsOptionValue
        ]);
    }

    /**
     * Updates an existing Files model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelOptionValue = $this->findModel($id);
        if (Yii::$app->request->post()) {
            $modelOptionValue->load(Yii::$app->request->post());
            $file = UploadedFile::getInstance($modelOptionValue, "file_name");
            if ($file != null)
            {
                $modelOptionValue->file_name = $file;
                $db_path = $modelOptionValue->file_path;
                if ($db_path == null) {
                    $db_path = '/files/'.date('Y').'/'.date('m').'/'.date('d');
                }
                $modelOptionValue->upload($db_path);
                if ($file != null){
                    $modelOptionValue->file_path = $db_path;
                    $modelOptionValue->file_size = $file->size;
                    $modelOptionValue->file_extension = $file->extension;
                }
            }

            $modelOptionValue->update(false);
            return $this->redirect(['/files']);
        }
        return $this->render('update', [
            'modelOptionValue' => $modelOptionValue
        ]);
    }

    /**
     * Deletes an existing Files model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $name = $model->title;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Files model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Files the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Files::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
