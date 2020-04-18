<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\assets\ItemAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form ActiveForm */

ItemAsset::register($this);


?>
<div class="ItemForm">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title') ?>


    <?php /** @var \common\models\Item $item */
    if (!empty($item->logo)) { ?>
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <a href="<?= $item->logoWebPath ?>" target="_blank" class="thumbnail">
                    <img src="<?= $item->logoWebPath ?>">
                </a>
            </div>
        </div>
    <?php } ?>

    <?= $form->field($model, 'file')->fileInput()->label('Photo') ?>

    <?php if ($action == 'update') { ?>
        <?= $this->render('item_options_update', ['item' => $item]) ?>
    <?php } ?>

    <div class="default-fields-end"></div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- ItemForm -->

