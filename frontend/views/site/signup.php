<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Рўйхатдан ўтиш';
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
                <?php $form = \yii\bootstrap4\ActiveForm::begin();?>
                    <div class="login-form">
                        <h4 class="login-title">New Customer</h4>
                        <p><span class="font-weight-bold">I am a new customer</span></p>
                        <div class="row">
                            <div class="col-md-12 col-12 mb--15">
                                <label for="email">Full Name</label>
                                <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Enter your full name'])->label(false)?>
                            </div>
                            <div class="col-12 mb--20">
                                <label for="email">Email</label>
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email','placeholder' => 'Enter Your Email Address Here..'])->label(false)?>
                            </div>
                            <div class="col-lg-12 mb--20">
                                <label for="password">Password</label>
                                <?= $form->field($model, 'password')->textInput(['maxlength' => true, 'type' => 'password','placeholder' => 'Enter your password'])->label(false)?>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outlined">Register</button>
                            </div>
                        </div>
                    </div>
                <?php \yii\bootstrap4\ActiveForm::end()?>
            </div>
        </div>
    </div>
</main>
