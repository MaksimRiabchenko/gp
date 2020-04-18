<?php

use backend\assets\items\ItemIndexAsset;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\UserHelper;


/* @var $this yii\web\View */

$header = 'Photo items';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => 'Photo Items',
];

ItemIndexAsset::register($this);
?>

<?php if (Yii::$app->user->can('addEditItems')) { ?>
    <div>
        <a href="<?= Url::to(['items/create' . (isset($category) ? '/' . $category->id : '')]) ?>" type="button"
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
                'label' => 'Картинка',
                'format' => 'raw',
                'value' => function($data){
                    return '<a href="'.$data->getLogoWebPath().'" target="_blank">'.Html::img(Url::toRoute($data->getLogoWebPath()),[
                        'alt'=>'yii2 - картинка в gridview',
                        'style' => 'width:150px;'
                    ]) . '</a>';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Yii::$app->user->can('addEditItems') ?
                            Html::a(
                                '<span class="glyphicon glyphicon-edit"></span> Edit',
                                $url, [
                                'class' => 'btn btn-default btn-xs'
                            ]) : '';
                    },
                    'delete' => function ($url, $model, $key) {
                        return Yii::$app->user->can('deleteItems') ?
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
