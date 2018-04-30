<?php
use yii\bootstrap\Nav;

/** @var $category */
echo Nav::widget( [
    'items'   => $items,
    'options' => [
        'class' => 'nav-pills'
    ]
] );