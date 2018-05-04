<?php
use yii\bootstrap\Nav;

/** @var $items */
echo Nav::widget( [
    'items'        => $items,
    'encodeLabels' => false,
    'options'      => [
        'class' => 'nav-tabs'
    ]
] );