<?php
/**
 * User: Администратор
 * Date: 05.04.2017
 * Time: 23:30
 */

use yii\bootstrap\Nav;

/** @var $category */
echo Nav::widget( [
    'items'   => $items,
    'options' => [
        'class' => 'nav-pills'
    ]
] );

?>
