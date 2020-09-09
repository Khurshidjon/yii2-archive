<?php

namespace backend\controllers;

use Yii;
use common\models\Files;
use backend\models\search\FilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
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
            $modelsOptionValue = Model::createMultiple(Files::classname());
            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());
            foreach ($modelsOptionValue as $index => $modelOptionValue) {
                $modelOptionValue->sort_order = $index;
                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]img");
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validateMultiple($modelsOptionValue);
            }

            // validate all models
            $valid = Model::validateMultiple($modelsOptionValue);

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                        foreach ($modelsOptionValue as $modelOptionValue) {
                            if (($flag = $modelOptionValue->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
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
        $modelCatalogOption = $this->findModel($id);
        $modelsOptionValue = $modelCatalogOption->optionValues;

        if ($modelCatalogOption->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsOptionValue, 'id', 'id');
            $modelsOptionValue = Model::createMultiple(OptionValue::classname(), $modelsOptionValue);
            Model::loadMultiple($modelsOptionValue, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsOptionValue, 'id', 'id')));

            foreach ($modelsOptionValue as $index => $modelOptionValue) {
                $modelOptionValue->sort_order = $index;
                $modelOptionValue->img = \yii\web\UploadedFile::getInstance($modelOptionValue, "[{$index}]img");
            }

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsOptionValue),
                    ActiveForm::validate($modelCatalogOption)
                );
            }

            // validate all models
            $valid = $modelCatalogOption->validate();
            $valid = Model::validateMultiple($modelsOptionValue) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCatalogOption->save(false)) {

                        if (!empty($deletedIDs)) {
                            $flag = OptionValue::deleteByIDs($deletedIDs);
                        }

                        if ($flag) {
                            foreach ($modelsOptionValue as $modelOptionValue) {
                                $modelOptionValue->catalog_option_id = $modelCatalogOption->id;
                                if (($flag = $modelOptionValue->save(false)) === false) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCatalogOption->id]);
                    }

                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelCatalogOption' => $modelCatalogOption,
            'modelsOptionValue' => (empty($modelsOptionValue)) ? [new OptionValue] : $modelsOptionValue
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
        $optonValuesIDs = ArrayHelper::map($model->optionValues, 'id', 'id');
        Files::deleteByIDs($optonValuesIDs);
        $name = $model->name;

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
