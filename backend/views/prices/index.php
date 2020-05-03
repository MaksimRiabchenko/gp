<?php

use backend\assets\prices\PriceIndexAsset;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UserHelper;

/* @var $this yii\web\View */

$header = 'Prices';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => 'Prices',
];

PriceIndexAsset::register($this);
?>

<?php if (Yii::$app->user->can('addEditPrices')) { ?>
    <div>
        <a href="<?= Url::to(['prices/create']) ?>" type="button"
           class="btn btn-primary ">
            Add new
        </a>
    </div>
<?php } ?>

<?php if (!empty($categoryId) || UserHelper::hasRole('admin')) { ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('addEditPrices') ?
                            Html::a(
                                '<span class="glyphicon glyphicon-edit"></span> Edit',
                                $url, [
                                'class' => 'btn btn-default btn-xs'
                            ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Yii::$app->user->can('deletePrice') ?
                            Html::button(
                                '<span class="glyphicon glyphicon-remove"></span> Delete',
                                [
                                    'class' => 'btn btn-danger btn-xs',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#myModal' . $model->id
                                ]) . $this->render('_modal_confirm', ['id' => $model->id]) :
                            '';
                    },
                ],
            ],
        ]
    ]); ?>
<?php } ?>
