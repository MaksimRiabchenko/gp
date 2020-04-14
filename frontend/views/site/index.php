<?php

use frontend\widgets\CategoriesList;
use frontend\widgets\ItemView;

?>
<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-9 padding-right">
                <h1>Добро пожаловать.</h1>
                <h3>О нас</h3>
                <div class="features_items"><!--features_items-->
                    <?php foreach ($items as $item) : ?>
                        <?= ItemView::widget(['item' => $item]) ?>
                    <?php endforeach; ?>

                    <?php if (empty($items)) { ?>
                        <big>Cyberring - это один из лучших компьютерных клубов Киева. Нашим гостям мы предоставляем:<br> </big>

                            <li> 70 высокопроизводительных компьютеров, 5 ps4, 4 vr;<br>
                        <li> высокоскоростной интернет 1GB;<br>
                        <li> Высокий сервис обслуживания;<br>
                        <li> Cyber ring создаёт идеальные условия для того что бы каждый наш гость мог стать профессионалом в своих любимых играх;<br>
                        <li> В нашем клубе вы сможете стать чемпионом!<br>
                        <li> Зона для отдыха, бар.</li>


                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>