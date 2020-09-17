<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Folders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="folders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php
        if (Yii::$app->controller->action->id == 'create'){
            echo $form->field($model, 'parent_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Folders::find()->all(), 'id', 'title'), ['prompt' => 'Пожалуйста выберите']);
        }elseif(Yii::$app->controller->action->id == 'child-create'){
            echo  $form->field($model, 'parent_id')->hiddenInput(['value' => $folder_id])->label(false);
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
