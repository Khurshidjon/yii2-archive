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
        'enableAjaxValidation' => false,
        'validateOnChange' => false,
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
    <?php
    $js = <<<JS
   $(function() {
        //   $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
        //     $( ".document_date" ).each(function() {
        //         $( this ).addClass("hasDatepicker");
        //         $( this ).datepicker({
        //           dateFormat : "dd/mm/yy",
        //           changeMonth: true,
        //           changeYear: true
        //        });
        //   });          
        // });
        // $(".dynamicform_wrapper").on("afterDelete", function(e, item) {
        //     $( ".document_date" ).each(function() {
        //        $( this ).removeClass("hasDatepicker").datepicker({
        //           dateFormat : "dd/mm/yy",
        //           changeMonth: true,
        //           changeYear: true
        //        });
        //   });          
        // });
   })
JS;

    $this->registerJs($js, \yii\web\View::POS_END);
    ?>
</div>
