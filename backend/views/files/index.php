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

    <p>
        <?= Html::a('Папка яратиш', [\yii\helpers\Url::toRoute(['folders/child-create', 'folder_id' => $folder_id])], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Файл қўшиш', ['create?folder_id='.$folder_id], ['class' => 'btn btn-info']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataFolders,
        'columns' => [
            [
                'header' => '<input type="checkbox">',
                'format' => 'raw',
                'value' => function($model){
                    return '<input type="checkbox">';
                }
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('<i class="fas fa-folder"></i> '.
                        $model->title, ['#'],
                        [
                            'class' => 'text-warning font-weight-bold db-click-href',
                            'style' => 'text-decoration:none;', 'onclick' => 'return false',  'ondblclick' => "window.location='/files/index?id=". $model->id ."'",
                        ]
                        );
                }
            ],
            [
                'attribute' => 'size',
                'value' => function($model){
                    return floor($model->fileSize / 1204) . ' КБ';
                }
            ],
            [
                'attribute' => 'count',
                'value' => function($model){
                    return $model->fileCount;
                }
            ],
//            'type',
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
                        return Html::a('<i class="metismenu-icon pe-7s-trash"></i>', ['/folders/delete', 'id' => $model->id], [
                            'style' => 'font-size: 20px',
                            'data' => [
                                'confirm' => 'Ushbu papkani rostan ham o\'chirmoqchimisiz?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ]
            ],
        ],
    ]);?>

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
