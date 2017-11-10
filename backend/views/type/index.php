<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы объявлений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'old_type',
            'name',
            'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
