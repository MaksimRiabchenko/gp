<?php

namespace backend\assets\prices;

use yii\web\AssetBundle;

/**
 * backend application asset bundle.
 */
class PriceIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [

        '/js/items/index.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
