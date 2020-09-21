<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Кириш';
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  mt--40 mt-lg--0">
                <div class="inner-page-sidebar">
                    <!-- Accordion -->
                    <div class="single-block">
                        <h3 class="sidebar-title">Categories</h3>
                        <ul class="sidebar-menu--shop">
                            <?php foreach (\common\models\Folders::find()->where(['parent_id' => null])->all() as $item):?>
                                <li><a href="#"><?= $item->title ?> (<?= $item->fileCountChild?>)</a></li>
                                <?php if ($item->fileCountChild): ?>
                                    <ul class="inner-cat-items">
                                        <?php foreach ($item->children as $child):?>
                                            <li><a href="#"><?= $child->title; ?> (<?= $child->fileCount?>)</a></li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-lg-2">
                <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']);?>
                    <div class="login-form">
                        <h4 class="login-title">Returning Customer</h4>
                        <p><span class="font-weight-bold">I am a returning customer</span></p>
                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Username</label>
                                <?= $form->field($model, 'username')->textInput(['maxlength' => true,'autofocus' => true, 'placeholder' => 'Enter your username here...'])->label(false)?>
                            </div>
                            <div class="col-12 mb--20">
                                <label for="password">Password</label>
                                <?= $form->field($model, 'password')->passwordInput(['type' => 'password','placeholder' => 'Enter your password'])->label(false)?>
                            </div>

                            <div class="col-12 mb--20">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Кириш</button>
                            </div>
                        </div>
                    </div>
                <?php \yii\bootstrap4\ActiveForm::end()?>
            </div>
        </div>
    </div>
</main>
