<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Folders */

$this->title = 'Create Folders';
$this->params['breadcrumbs'][] = ['label' => 'Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folders-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->controller->action->id == 'create'): ?>
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
    <?php elseif (Yii::$app->controller->action->id == 'child-create'): ?>
        <?= $this->render('_form', [
            'model' => $model,
            'folder_id' => $folder_id
        ]) ?>
    <?php endif?>

</div>
