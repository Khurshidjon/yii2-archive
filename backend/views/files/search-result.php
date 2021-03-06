<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $folder_id \common\models\Folders */

$this->title = 'Файллар';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'folder_id',
            [
                'attribute' => 'category_id',
                'value' => function($model){
                    return $model->category->title;
                }
            ],
//            'type_id',
            //'file_cover',
            //'document_number',
            //'document_date',
            //'document_description:ntext',
            //'document_author',
//            'file_name',
            [
                'attribute' => 'file_size',
                'value' => function($model){
                    return floor($model->file_size / 1024) . ' КБ';
                }
            ],
            //'file_extension',
            //'file_path',
            [
                'attribute' => 'created_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s", $model->created_at);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model){
                    return date("Y-m-d H:i:s", $model->updated_at);
                }
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Жараёнлар',
                'buttons' => [
                    'view' => function($url, $model){
                        return Html::a('<i class="metismenu-icon pe-7s-look"></i>', ['view', 'id' => $model->id], [
                            'style' => 'font-size: 20px',
                        ]);
                    },
                    'update' => function($url, $model){
                        return Html::a('<i class="metismenu-icon pe-7s-eyedropper"></i>', ['update', 'id' => $model->id], [
                            'class' => 'mx-2',
                            'style' => 'font-size: 20px',
                        ]);
                    },
                    'delete' => function($url, $model){
                        return Html::a('<i class="metismenu-icon pe-7s-trash"></i>', ['delete', 'id' => $model->id], [
                            'style' => 'font-size: 20px',
                            'data' => [
                                'confirm' => 'Ushbu fileni rostan ham o\'chirmoqchimisiz?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
