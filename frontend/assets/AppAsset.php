<?php

namespace frontend\assets;

use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/style.css',
    ];
    public $js = [
        'js/scripts.js'
    ];
    public $depends = [
        YiiAsset::class,
        ResetAsset::class,
        BootstrapPluginAsset::class,
    ];
}
