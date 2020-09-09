<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAssetArchive extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/template';
    public $css = [
        'css/plugins.css',
        'css/main.css',
    ];
    public $js = [
        'js/plugins.js',
        'js/ajax-mail.js',
        'js/custom.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
