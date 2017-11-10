<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новые объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Adverts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'old_id',
//            'sid',
//            'cat_id',
//            'subcat_id',
            // 'type',
            [
                'attribute' => 'Header',
                'contentOptions' =>['style'=>'white-space: pre-line;'],
                'value'=>'header',
            ],
            [
                'attribute'=>'Comment',
                'contentOptions' =>['style'=>'white-space: normal;'],
                'value'=>'comment',
            ],
            // 'city',
             'price',
             'period',
            // 'active',
            // 'selected',
            // 'special',
            // 'images',
             'ip',
//             'created_at',
            [
            	'attribute' => 'created_at',
//              'header' => 'Create',
              'format' => ['date', 'php:d:m:Y'],
						],
//						[
//								'attribute' => 'updated_at',
//								'format' => ['date', 'php:d:m:Y'],
//						],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
