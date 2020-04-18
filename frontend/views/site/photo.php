<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\widgets\ItemView;

$this->title = 'Фото галерея';
$this->params['breadcrumbs'][] = $this->title;
$i = 1;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <script language="JavaScript">
        $(document).ready(function() {
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title');
                    }
                }
            });
        });
    </script>

    <div class="popup-gallery">
        <?php foreach ($items as $item) : ?>
            <?php
            echo ItemView::widget(['item' => $item]);
            if ($i % 3 == 0) echo '<br clear="all">';
            $i++;
            ?>
        <?php endforeach; ?>
    </div>
</div>
