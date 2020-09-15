<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Files */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Update Files: ' . $modelOptionValue->title;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelOptionValue->title, 'url' => ['view', 'id' => $modelOptionValue->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="files-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => false,
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

    <table class="table table-bordered table-striped margin-b-none">
        <thead>
        <tr>
            <th></th>
            <th>File information</th>
            <th>Document information</th>
            <th>File</th>
        </tr>
        </thead>
        <tbody class="form-options-body">
            <tr class="form-options-item">
                <td class="sortable-handle text-center vcenter" style="cursor: move;">
                    <i class="far fa-arrows"></i>
                </td>
                <td class="vcenter">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($modelOptionValue, "title")->textInput(['maxlength' => 128]); ?>
                        </div>
                        <div class="col-md-9">
                            <?= $form->field($modelOptionValue, "category_id")->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Categories::find()->where(['not', ['parent_id' => null]])->all(), 'id', 'title'), ['prompt' => 'Пожалуйста выберите']) ?>
                            <?= $form->field($modelOptionValue, "folder_id")->hiddenInput(['value' => $modelOptionValue->folder_id])->label(false) ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($modelOptionValue, "file_page_count")->textInput(['maxlength' => 128]); ?>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($modelOptionValue, "document_number")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelOptionValue, "document_date")->widget(\kartik\date\DatePicker::className(), [
                                'options' => [
                                    'autocomplete'=>'off',
                                    'readOnly' => true,
                                    'style' => 'background:white'
                                ],
                                'pluginOptions' => [
                                    'autoClose' => true
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($modelOptionValue, "document_author")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($modelOptionValue, "document_description")->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $modelFile = \common\models\Files::findOne($modelOptionValue->id);
                            $initialPreview = [];
                            if ($modelFile) {
                                $pathFile =  'http://front.archive.loc' .$modelFile->file_path.'/'.$modelFile->file_name;
                                if (in_array($modelFile->file_extension, array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG"))){
                                    $initialPreview[] = Html::img($pathFile, ['style' => 'width: 200px; 120px']);
                                }elseif (in_array($modelFile->file_extension, array("mp4", "mov", "avi"))){
                                    $initialPreview[] = '<video src="'. $pathFile .'" class="w-100" controls height="160"></video>';
                                }elseif ($modelFile->file_extension == 'pdf'){
                                    $initialPreview[] = '<iframe class="w-100" src="' . $pathFile .'"></iframe>';
                                }elseif ($modelFile->file_extension == 'docx'){
                                    $initialPreview[] = '<iframe class="w-100" src="' . $pathFile .'"></iframe>';
                                }else{
                                    $initialPreview[] = Yii::$app->params['previewFileIconSettings'][$modelFile->file_extension];
                                }
                            }
                            ?>
                            <?= $form->field($modelOptionValue, "fileInput")->label(false)->widget(FileInput::classname(), [
                                'options' => [
                                    'multiple' => false,
//                                        'accept' => 'image/*',
//                                        'class' => 'optionvalue-img'
                                ],
                                'pluginOptions' => [
                                    'previewFileType' => 'image',
                                    'showCaption' => false,
                                    'showUpload' => false,
                                    'showZoom' => false,
                                    'browseClass' => 'btn btn-default btn-sm',
                                    'browseLabel' => ' Загрузить',
                                    'cancelIcon' => ' <i class="fas fa-times"></i>',
                                    'cancelLabel' => ' Отменить',
                                    'browseIcon' => '<i class="fas fa-image"></i>',
                                    'removeClass' => 'btn btn-danger btn-sm',
                                    'removeLabel' => ' Удалить',
                                    'removeIcon' => '<i class="fas fa-trash"></i>',
                                    'previewSettings' => [
//                                        'image' => ['width' => '208px', 'height' => 'auto'],
//                                        'video' => ['width' => '248px', 'height' => 'auto'],
                                    ],
                                    'previewFileIconSettings' => [
                                        'doc' => '<i class="fas fa-file-word text-primary"></i>',
                                        'docx' => '<i class="fas fa-file-word text-primary"></i>',
                                        'xls' => '<i class="fas fa-file-excel text-success"></i>',
                                        'xlsx' => '<i class="fas fa-file-excel text-success"></i>',
                                        'ppt' => '<i class="fas fa-file-powerpoint text-danger"></i>',
                                        'pptx' => '<i class="fas fa-file-powerpoint text-danger"></i>',
                                        'pdf' => '<i class="fas fa-file-pdf text-danger"></i>',
                                        'zip' => '<i class="far fa-file-archive text-muted"></i>',
                                        'html' => '<i class="fas fa-file-code text-info"></i>',
                                        'txt' => '<i class="fas fa-file-text text-info"></i>',
                                        'mov' => '<i class="fas fa-file-movie text-warning"></i>',
                                        'mp3' => '<i class="fas fa-file-audio text-warning"></i>',
                                        'jpg' => '<i class="fas fa-file-photo text-warning"></i>',
                                    ],
                                    'initialPreview' => $initialPreview,
                                    'layoutTemplates' => ['footer' => '']
                                ]
                            ]) ?>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-paper-plane"></i> Отправить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
