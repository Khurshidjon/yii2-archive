<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\FilesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'folder_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'file_cover') ?>

    <?php // echo $form->field($model, 'document_number') ?>

    <?php // echo $form->field($model, 'document_date') ?>

    <?php // echo $form->field($model, 'document_description') ?>

    <?php // echo $form->field($model, 'document_author') ?>

    <?php // echo $form->field($model, 'file_name') ?>

    <?php // echo $form->field($model, 'file_size') ?>

    <?php // echo $form->field($model, 'file_extension') ?>

    <?php // echo $form->field($model, 'file_path') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
