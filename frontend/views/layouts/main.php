<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

use dvizh\cart\widgets\ElementsList;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="logo pull-left">
                            <a href="/"><img src="/images/home/logo3.jpg" alt="" /></a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <h4 style="color:#ffffff">Звоните 24/7: <a href="tel:+380666853442">&nbsp +38 066 6853442</a></h4></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i style="color:#ffffff" class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i style="color:#ffffff" class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://instagram.com/max_primachenko?igshid=12vhacmjdwqhr" target="_blank"><i style="color:#ffffff" class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.youtube.com" target="_blank"><i style="color:#ffffff" class="fa fa-youtube-play"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">

                    <div class="col-sm-8">
                        <div class="shop-menu pull-left">
                            <?php
                                $menuItems = [
                                    ['label' => 'Главная', 'url' => ['/site/index']],
                                    ['label' => 'Фото галерея', 'url' => ['/site/photo']],
                                    ['label' => 'Цены', 'url' => ['/site/price']],
                                    ['label' => 'Контакты', 'url' => ['/site/contact']],
                                ];
                                echo Nav::widget([
                                    'options' => ['class' => 'navbar-nav navbar-right'],
                                    'items' => $menuItems,
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->

        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->

    <div class="container">
        <div class="breadcrumbs">

        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>
</div>


<footer id="footer"><!--Footer-->



    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © <?= date('Y')?> <a href="gpyro.com">gpyro.com</a>. All rights reserved.</p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
