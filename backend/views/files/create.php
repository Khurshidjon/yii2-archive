<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Files */

$this->title = 'Create Files';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-create">
    <?= $this->render('_form', [
        'modelsOptionValue' => $modelsOptionValue,
        'folder_id' => $folder_id
    ]) ?>
</div>
