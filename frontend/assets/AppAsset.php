<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/prettyPhoto.css',
        'css/price-range.css',
        'css/animate.css',
        'css/main.css',
        'css/responsive.css',
        'css/magnific-popup.css',
        'css/jquery-ui.css'
    ];
    public $js = [
        'js/html5shiv.js',
        'js/price-range.js',
        'js/jquery.scrollUp.min.js',
        'js/bootstrap.min.js',
        'js/jquery.prettyPhoto.js',
        'js/main.js',
        'js/jquery.magnific-popup.min.js',
        'js/jquery-ui.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
