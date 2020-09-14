<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-book-form'
        ]
    ]); ?>

        <div class="container-fluid">
            <?= $this->render('dynamic-form', [
                'form' => $form,
                'modelsOptionValue' => $modelsOptionValue,
                'folder_id' => $folder_id
            ]) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('<i class="fas fa-paper-plane"></i> Отправить', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
