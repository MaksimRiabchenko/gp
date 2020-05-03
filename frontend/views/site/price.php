<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\PriceView;

$this->title = 'Цены';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .dialog {
        display: none;
        width: 800px;
        background: grey;
    }
</style>
<script language="JavaScript">
    function openDialog(id) {
        $('#' + id).dialog({
            modal: true,
            height: 290,
            width: 405,
            closeText: 'Закрыть',
            create: function( event, ui ) {
            }
        });
    }
</script>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="pBody _tw_css_5e93264ce1107940231">
        <?php foreach ($prices as $price) : ?>
            <?php
            echo PriceView::widget(['price' => $price]);
            ?>
        <?php endforeach; ?>
    </div>
</div>

