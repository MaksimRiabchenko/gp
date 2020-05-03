<?php

$this->params['breadcrumbs'][] = [
    'label' => 'Prices',
    'url' => ['/prices'],
];

$header = ucfirst($action) . ' prices page';
$this->title = $header;
$this->params['breadcrumbs'][] = [
    'label' => $header,
];

?>

<?= $this->render('_form', [
    'category' => !empty($category) ? $category : null,
    'price' => $action != 'create' ? $price : null,
    'model' => $formModel,
    'action' => $action
]); ?>
