<?php

use yii\helpers\Html;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;

?>

    <div id="panel-option-values" class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fas fa-file-archive"></i> Option values</h3>
        </div>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.form-options-body',
            'widgetItem' => '.form-options-item',
            'min' => 1,
            'limit' => 4,
            'insertButton' => '.add-item',
            'deleteButton' => '.delete-item',
            'model' => $modelsOptionValue[0],
            'formId' => 'dynamic-book-form',
            'formFields' => [
                'title',
                'file_name',
                'folder_id',
                'category_id',
                'document_number',
                'document_date',
                'document_description',
                'document_author'
            ],
        ]); ?>
        <table class="table table-bordered table-striped margin-b-none">
            <thead>
                <tr>
                    <th></th>
                    <th>Option value name</th>
                    <th>Option value name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="form-options-body">
            <input type="hidden" name="folder_id" value="<?= $folder_id?>">
            <?php foreach ($modelsOptionValue as $index => $modelOptionValue): ?>
                <tr class="form-options-item">
                    <td class="sortable-handle text-center vcenter" style="cursor: move;">
                        <i class="far fa-arrows"></i>
                    </td>
                    <td class="vcenter">
                        <div class="row">
                            <div class="col-md-9">
                                <?= $form->field($modelOptionValue, "[{$index}]title")->textInput(['maxlength' => 128]); ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($modelOptionValue, "[{$index}]file_page_count")->textInput(['maxlength' => 128]); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($modelOptionValue, "[{$index}]category_id")->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Categories::find()->where(['not', ['parent_id' => null]])->all(), 'id', 'title'), ['prompt' => 'Пожалуйста выберите']) ?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($modelOptionValue, "[{$index}]document_number")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelOptionValue, "[{$index}]document_date")->textInput()?>
                                <?php /*$form->field($modelOptionValue, "[{$index}]document_date")->widget(\kartik\date\DatePicker::className(), [
                                        'options' => [
                                            'autocomplete'=>'off',
                                            'readOnly'=>true,
                                            'style' => 'background:white'
                                        ],
                                        'pluginOptions' => [
                                                'autocomplete' => false
                                        ]
                                ]) */?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelOptionValue, "[{$index}]document_author")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($modelOptionValue, "[{$index}]document_description")->textarea(['rows' => 4]) ?>
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
                                    $pathImg =  'http://front.archive.loc' .$modelFile->file_path .'/'.$modelFile->file_name;
                                    if (in_array($modelFile->file_extension, array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG"))){
                                        $initialPreview[] = Html::img($pathImg, ['class' => 'w-100']);
                                    }elseif (in_array($modelFile->file_extension, array("mp4", "mov", "avi"))){
                                        $initialPreview[] = '<video src="'. $pathImg .'" class="w-100" controls height="160"></video>';
                                    }else{
                                        $initialPreview[] = Yii::$app->params['previewFileIconSettings'][$modelFile->file_extension];
                                    }
                                }
                                ?>
                                <?= $form->field($modelOptionValue, "[{$index}]fileInput")->label(false)->widget(FileInput::classname(), [
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
//                                    'image' => ['width' => '138px', 'height' => 'auto']
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
//                                        'initialPreview' => $initialPreview,
                                        'layoutTemplates' => ['footer' => '']
                                    ]
                                ]) ?>
                            </div>
                        </div>
                    </td>
                    <td class="text-center vcenter">
                        <button type="button" class="delete-item btn btn-danger btn-xs"><i class="fas fa-minus"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td><button type="button" class="add-item btn btn-info btn-sm"><span class="fas fa-plus"></span> Новый</button></td>
                </tr>
            </tfoot>
    </table>
        <?php DynamicFormWidget::end(); ?>
    </div>

<?php
$this->registerJs(' 
$(".optionvalue-img").on("filecleared", function(event) {
    var regexID = /^(.+?)([-\d-]{1,})(.+)$/i;
    var id = event.target.id;
    var matches = id.match(regexID);
    if (matches && matches.length === 4) {
        var identifiers = matches[2].split("-");
        $("#optionvalue-" + identifiers[1] + "-deleteimg").val("1");
    }
});

var fixHelperSortable = function(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
};

$(".form-options-body").sortable({
    items: "tr",
    cursor: "move",
    opacity: 0.6,
    axis: "y",
    handle: ".sortable-handle",
    helper: fixHelperSortable,
    update: function(ev){
        $(".dynamicform_wrapper").yiiDynamicForm("updateContainer");
    }
}).disableSelection();
');
?>