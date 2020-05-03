<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * backend application asset bundle.
 */
class PriceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [

        '/js/items/create_form.js'

    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
