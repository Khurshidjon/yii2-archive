<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main backend application asset bundle.
 */
class AppAssetBackendArchive extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/template/assets';
    public $css = [
        'css/main.css',
        'css/style.css',
    ];
    public $js = [
        'scripts/main.js',
        'https://use.fontawesome.com/releases/v5.3.1/js/all.js',
        'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        \Yii::$app->view->on(View::EVENT_AFTER_RENDER, function () {
            unset(\Yii::$app->view->assetBundles['yii\bootstrap\BootstrapAsset']);
        });
        \Yii::$app->view->on(View::EVENT_BEGIN_BODY, function () {
            unset(\Yii::$app->view->assetBundles['yii\bootstrap\BootstrapAsset']);
        });
    }
}
