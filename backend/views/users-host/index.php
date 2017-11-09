<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QAuthUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qauth Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="qauth-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qauth User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'QAuthUserID',
            [
                'header' => 'Email',
                'attribute' => 'QAuthUserEmail',
                'value'  => 'QAuthUserEmail',
            ],
						[
                'header' => 'Username',
                'attribute' => 'QAuthUserUserName',
                'value'  => 'QAuthUserUserName',
						],
//            'QAuthUserPassHash',
//            'QAuthUserActivationHash',
            // 'QAuthUserGroupID',
						[
							'header' => 'Status',
							'attribute' => 'QAuthUserStatus',
							/*'filter' => [
									'1' => 'a',
									'2' => 'b'
							]*/
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
                'header' => 'IP',
                'attribute' => 'QAuthUserLastIP',
                'value'  => 'QAuthUserLastIP',
            ],
            [
                'header' => 'FullName',
                'attribute' => 'QAuthUserFullName',
                'value'  => 'QAuthUserFullName',
            ],
            // 'QAuthUserCompany',
            // 'QAuthUserWebsite',
            // 'QAuthUserPhone',
            [
                'header' => 'City',
                'attribute' => 'QAuthUserCity',
                'value'  => 'QAuthUserCity',
            ],
            // 'QAuthUserAddress',
            // 'QAuthUserZip',
            // 'QAuthUserICQ',
            // 'QAuthUserSkype',
            // 'QAuthUserTwitter',
            // 'QAuthUserLJ',
            // 'QAuthUserDOB',
            // 'QAuthUserGender',
            // 'QAuthUserRating',
            // 'QAuthUserAbout:ntext',
            // 'QAuthUserExtra:ntext',
//             'rights',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
