<?php

use dvizh\cart\widgets\BuyButton;
use yii\helpers\Url;

/** @var Item $item */

?>
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <a href="<?= $item->logoWebPath ?>" title="<?= $item->title ?>"><img src="<?= $item->logoWebPath ?>"></a>
            </div>
        </div>
    </div>
</div>