<?php

use yii\helpers\Url;

/** @var Price $price */

?>
<br><h1 align="center" style="color:#ff001b"><?= $price->title ?></h1>
<?= $price->article ?>

<div class="pFoot">
    <a href="javascript:void(0)" onclick="openDialog('dialog_<?=$price->id?>')"><h3 align="center">Подробно</h3></a>

    <div id="dialog_<?=$price->id?>" title="<?=$price->title?>" class="dialog">
        <p><?=$price->description?></p>
    </div>

</div>