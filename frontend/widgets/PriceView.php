<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class PriceView extends Widget
{
    public $price;

    public function run()
    {
        return $this->render('price-view', ['price' => $this->price]);
    }

} 