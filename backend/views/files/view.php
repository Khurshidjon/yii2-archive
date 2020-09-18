<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Files */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="files-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
        $modelFile = \common\models\Files::findOne($model->id);
        $initialPreview = '';
        if ($modelFile) {
            $pathFile =  \yii\helpers\Url::base(true). $modelFile->file_path.'/'.$modelFile->file_name . '.' . $modelFile->file_extension;
            if (in_array($modelFile->file_extension, array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG"))){
                $initialPreview = Html::img($pathFile, ['style' => 'width: 200px; 120px']);
            }elseif (in_array($modelFile->file_extension, array("mp4", "mov", "avi"))){
                $initialPreview = '<video src="'. $pathFile .'" class="w-100" controls height="160"></video>';
            }elseif (in_array($modelFile->file_extension, array("mp3", "m4a"))){
                $initialPreview = '<audio src="'. $pathFile .'" class="w-100" controls height="160"></video>';
            }elseif ($modelFile->file_extension == 'pdf'){
                $initialPreview = '<iframe class="w-100" src="' . $pathFile .'"></iframe>';
            }else{
                $initialPreview = Yii::$app->params['previewFileIconSettings'][$modelFile->file_extension];
            }
        }
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'folder_id',
            'category_id',
//            'type_id',
//            'file_cover',
//            'document_number',
            'document_date',
            'document_description:ntext',
            'document_author',
//            'file_name',
            'file_size',
//            'file_extension',
//            'file_path',
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date("d.m.Y", $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return date("d.m.Y", $model->updated_at);
                }
            ],
            'title',
            [
                'attribute' => 'fileInput',
                'format' => 'raw',
                'value' => function($model) use ($initialPreview){
                    return $initialPreview;
                }
            ],
            [
                'attribute' => 'downloadButton',
                'format' => 'raw',
                'value' => function($model) use ($pathFile){
                    return '<a href="'. $pathFile .'" download class="btn btn-info">Юклаб олиш</a>';
                }
            ]
        ],
    ]) ?>

</div>
