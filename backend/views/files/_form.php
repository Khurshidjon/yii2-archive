<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]); ?>

  <div class="container-fluid">
      <?= $this->render('dynamic-form', [
          'form' => $form,
          'modelsOptionValue' => $modelsOptionValue
      ]) ?>

      <div class="row">
          <div class="col-md-4">
<!--              --><?//= $form->field($model, 'folder_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Folders::find()->all(), 'id', 'title'), ['prompt' => 'Пожалуйста выберите']) ?>
          </div>
          <div class="col-md-4">
<!--              --><?//= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Categories::find()->where(['not', ['parent_id' => null]])->all(), 'id', 'title'), ['prompt' => 'Пожалуйста выберите']) ?>
          </div>
          <div class="col-md-4">
<!--              --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-6">
             <!-- --><?/*= $form->field($model, 'file_cover')->widget(\kartik\file\FileInput::className(), [
                       'pluginOptions' => [
                            'initialPreview'=>[

                            ],
                            'browseClass' => 'btn btn-success',
                            'browseIcon' => '<i class="fas fa-book-open"></i> ',
                            'uploadClass' => 'btn btn-info',
                            'removeClass' => 'btn btn-danger',
                            'removeIcon' => '<i class="fas fa-trash"></i>',
                            'removeLabel' =>  'Удалить файл',
                            'browseLabel' =>  'Выбрать файл',
                            'cancelLabel' =>  'Отмена',
                            'initialPreviewConfig' => [
                               'doc' => '<i class="fas fa-file-word text-primary"></i>',
                               'xls' => '<i class="fas fa-file-excel text-success"></i>',
                               'ppt' => '<i class="fas fa-file-powerpoint text-danger"></i>',
                               'pdf' => '<i class="fas fa-file-pdf text-danger"></i>',
                               'zip' => '<i class="fas fa-file-archive text-muted"></i>',
                               'htm' => '<i class="fas fa-file-code text-info"></i>',
                               'txt' => '<i class="fas fa-file-text text-info"></i>',
                               'mov' => '<i class="fas fa-file-movie-o text-warning"></i>',
                               'mp3' => '<i class="fas fa-file-audio text-warning"></i>',
                               'jpg' => '<i class="fas fa-file-image text-danger"></i>',
                               'gif' => '<i class="fas fa-file-image text-warning"></i>',
                               'png' => '<i class="fas fa-file-image text-primary"></i>'
                           ],
                       ],
              ]) */?>
          </div>
      </div>

  </div>
    <?php //$form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'document_date')->textInput() ?>

    <?php //$form->field($model, 'document_description')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'document_author')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'file_size')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'file_extension')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'file_path')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
$js = <<< JS

JS;
    $this->registerJs($js, \yii\web\View::POS_END)
    ?>
</div>
