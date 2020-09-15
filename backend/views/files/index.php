<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $folder_id \common\models\Folders */

$this->title = 'Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Files', ['create?folder_id='.$folder_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
//            'folder_id',
            'category_id',
//            'type_id',
            //'file_cover',
            //'document_number',
            //'document_date',
            //'document_description:ntext',
            //'document_author',
            'file_name',
            'file_size',
            //'file_extension',
            //'file_path',
            'created_at',
            'updated_at',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Actions',
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
