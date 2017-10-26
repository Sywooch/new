<?php
/**
 * File: getDataHostUser.php
 * Email: becksonq@gmail.com
 * Date: 26.10.2017
 * Time: 19:13
 */

use yii\grid\GridView;

/* @var $dataProvider backend\controllers\UsersHostController */
?>

	<a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>">Вернуться в начало</a>
	<hr>

<?=

GridView::widget( [
    'dataProvider' => $dataProvider,
    'columns'      => [
        [ 'class' => 'yii\grid\SerialColumn' ],
        //        'QAuthUserID',
        [
            'header' => 'Email',
            'value'  => 'QAuthUserEmail',
        ],
        [
            'header' => 'Username',
            'value'  => 'QAuthUserUserName',
        ],
        [
            'header' => 'FullName',
            'value'  => 'QAuthUserFullName',
        ],
        [
            'header'    => 'Created',
            'attribute' => 'QAuthUserCreated',
            'format'    => [ 'date', 'php:d:m:Y' ]
        ],
        [
            'header' => 'Last Enter',
            'value'  => 'QAuthUserLastAuthDate',
            'format' => [ 'date', 'php:d:m:Y' ]
        ],
        [
            'header'    => 'Status',
            'attribute' => 'QAuthUserStatus',
            'filter'    => [
                '1' => 'Активирован',
                '2' => 'Не активирован'
            ],
        ],
        [
            'header' => 'City',
            'value'  => 'QAuthUserCity',
        ],
        [
            'header' => 'IP',
            'value'  => 'QAuthUserLastIP',
        ],
    ]
] );