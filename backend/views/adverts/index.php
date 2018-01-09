<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \frontend\models\adverts\AdvertsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Adverts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'old_id',
            'sid',
            'cat_id',
            'subcat_id',
            // 'type',
            // 'header',
            // 'description:ntext',
            // 'country',
            // 'period',
            // 'author',
            // 'email:email',
            // 'active',
            // 'selected',
            // 'selected_old',
            // 'special',
            // 'special_old',
            // 'images_old',
            // 'ip',
            // 'created_at',
            // 'updated_at',
            // 'draft',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
