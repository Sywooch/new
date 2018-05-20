<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Categories;
use yii\helpers\ArrayHelper;
use backend\models\Subcategories;
use backend\models\Types;
use backend\models\Countries;
use backend\models\Periods;

/* @var $this yii\web\View */
/* @var $searchModel \frontend\models\adverts\AdvertsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adverts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
      <?= Html::a( 'Create Adverts', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            'id',
            //            'old_id',
            //            'sid',
            [
                'attribute' => 'cat_id',
                'label'     => 'Категория',
                'format'    => 'raw',
                'value'     => 'category.category_name',
                'filter'    => ArrayHelper::map( Categories::find()->all(), 'id', 'category_name' ),
            ],
            [
                'attribute'      => 'subcat_id',
                'label'          => 'Подкатегория',
                'format'         => 'raw',
                'value'          => 'subcategory.subcat_name',
                'filter'         => ArrayHelper::map( Subcategories::find()->all(), 'id', 'subcat_name' ),
                'contentOptions' => [ 'style' => 'width: 100px; max-width: 140px;' ],
            ],
            [
                'attribute' => 'type_id',
                'label'     => 'Тип',
                'format'    => 'raw',
                'value'     => 'type.name',
                'filter'    => ArrayHelper::map( Types::find()->all(), 'id', 'name' ),
            ],
            [
                'attribute'      => 'header',
                'contentOptions' => [ 'style' => 'width: 100px; max-width: 180px;' ],
            ],
            //             'description:ntext',
            [
                'attribute' => 'country_id',
                'label'     => 'Расположение',
                'format'    => 'raw',
                'value'     => 'country.country_name',
                'filter'    => ArrayHelper::map( Countries::find()->all(), 'id', 'country_name' ),
            ],
            [
                'attribute' => 'period_id',
                'label'     => 'Период',
                'format'    => 'raw',
                'value'     => 'period.period',
                'filter'    => ArrayHelper::map( Periods::find()->all(), 'id', 'period' ),
            ],
            'author',
            'email:email',
            'active',
            'selected',
            // 'selected_old',
            'special',
            // 'special_old',
            // 'images_old',
            // 'ip',
            // 'created_at',
            // 'updated_at',
            'draft',
            'has_images',

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
