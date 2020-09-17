<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FoldersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Folders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            'type',
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
                        return Html::a('<i class="metismenu-icon pe-7s-trash"></i>', ['delete', 'id' => $model->id], [
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
    ]);

    $script = <<<JS
        // function dbClick()
        // {
        //     $('.db-click-href').click(function() {
        //         return false;
        //     }).dblclick(function(e) {
        //         window.location = this.href;
        //         return false;
        //     });
        // }
JS;

$this->registerJs($script, \yii\web\View::POS_END)

?>

