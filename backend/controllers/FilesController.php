<?php

namespace backend\controllers;

use backend\models\search\FoldersSearch;
use common\models\FileLanguage;
use Yii;
use common\models\Files;
use backend\models\search\FilesSearch;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'create', 'update', 'view', 'search-result', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Files models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $searchModel = new FilesSearch();
        $searchFolder = new FoldersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataFolders = $searchFolder->searchParentFolder(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'folder_id' => $id,
            'dataFolders' => $dataFolders
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
            'folder_id' => $id
        ]);
    }

    /**
     * Creates a new Files model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($folder_id)
    {
        $modelsOptionValue = [new Files];
        if (Yii::$app->request->post()) {
            $modelsOptionValue = \backend\models\Model::createMultiple(Files::className());
            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());

            foreach ($modelsOptionValue as $index => $modelOptionValue) {
                $modelOptionValue->folder_id = Yii::$app->request->post('folder_id');
                $modelOptionValue->document_date = (int)$modelOptionValue->document_date;
                $file = UploadedFile::getInstance($modelOptionValue, "[{$index}]fileInput");
                $modelOptionValue->save(false);
                if ($file != null OR !empty($file)) {
                    $modelOptionValue->upload($file);
                }
            }
            return $this->redirect(['/files', 'id' => $folder_id]);
        }
        return $this->render('create', [
            'modelsOptionValue' => (empty($modelsOptionValue)) ? [new Files] : $modelsOptionValue,
            'folder_id' => $folder_id
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
        if ($modelOptionValue->load(Yii::$app->request->post())) {
            $modelOptionValue->document_date = (int)$modelOptionValue->document_date;
//            vd($modelOptionValue);
            $file = UploadedFile::getInstance($modelOptionValue, "fileInput");
            $modelOptionValue->save(false);
            if ($file != null OR !empty($file)){
                $modelOptionValue->upload($file);
            }
            return $this->redirect(['/files', 'id' => $modelOptionValue->folder_id]);

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
        $folder_id = $model->folder_id;
        $file = Yii::getAlias('@frontend/web') . $model->file_path . '/' . $model->file_name;
        if ($model->delete()) {
            if ($file){
                unlink(Yii::getAlias('@frontend/web') . $model->file_path . '/' . $model->file_name);
            }else{
                throw new NotFoundHttpException('Ushbu fayl serverga yuklanmagan');
            }
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

        return $this->redirect(['index', 'id' => $folder_id]);
    }

    public function actionSearchResult()
    {
        $searchModel = new FilesSearch();
        $dataProvider = $searchModel->searchResult(Yii::$app->request->queryParams);
        return $this->render('search-result', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
