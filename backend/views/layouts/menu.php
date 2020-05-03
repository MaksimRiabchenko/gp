<?php

use backend\helpers\ViewHelper;

echo dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items' => [
            [
                'label' => Yii::t('app', 'Users'),
                'url' => ['/user/admin/index'],
                'icon' => ' fa-users',
                'visible' => Yii::$app->user->can('manageUsers')
            ],
            [
                'label' => Yii::t('app', 'Photo items'),
                'url' => ['/items'],
                'active' => ViewHelper::isActive($this->context, 'items', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('items') ||
                    Yii::$app->user->can('deleteItems') ||
                    Yii::$app->user->can('addEditItems')
            ],
            [
                'label' => Yii::t('app', 'Prices'),
                'url' => ['/prices'],
                'active' => ViewHelper::isActive($this->context, 'prices', ['index', 'create', 'update']),
                'visible' => Yii::$app->user->can('prices') ||
                    Yii::$app->user->can('deletePrice') ||
                    Yii::$app->user->can('addEditPrices')
            ],
            [
                'label' => 'Gii',
                'icon' => 'file-code-o',
                'url' => ['/gii'],
                'visible' => Yii::$app->user->can('developerTools')
            ],
            [
                'label' => 'Debug',
                'icon' => 'dashboard',
                'url' => ['/debug'],
                'visible' => Yii::$app->user->can('developerTools')
            ],
            [
                'label' => 'Login',
                'url' => ['main/login'],
                'visible' => Yii::$app->user->isGuest
            ],
            [
                'label' => 'Dev tools',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    [
                        'label' => 'Gii',
                        'icon' => 'file-code-o',
                        'url' => ['/gii'],
                        Yii::$app->user->can('developerTools')
                    ],
                    [
                        'label' => 'Debug',
                        'icon' => 'dashboard',
                        'url' => ['/debug'],
                        Yii::$app->user->can('developerTools')
                    ],
                ],
            ],
        ],
    ]
) ?>