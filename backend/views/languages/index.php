<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LanguagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="languages-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Languages', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'header' => 'Actions',
                'buttons' => [
                    'view' => function($url, $model){
                        return Html::a('<i class="metismenu-icon pe-7s-look"></i>', ['show', 'id' => $model->id], [
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
                                'confirm' => 'Ushbu tilni rostan ham o\'chirmoqchimisiz?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>


</div>
