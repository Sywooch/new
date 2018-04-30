<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResponsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Responses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responses-index">

	<h1><?= Html::encode( $this->title ) ?></h1>
	<?php Pjax::begin(); ?>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a( 'Create Responses', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
			'dataProvider' => $dataProvider,
			'filterModel'  => $searchModel,
			'columns'      => [
					[ 'class' => 'yii\grid\SerialColumn' ],

					'id',
					'name',
					'email:email',
					'phone',
					'message:ntext',

					[ 'class' => 'yii\grid\ActionColumn' ],
			],
	] ); ?>
	<?php Pjax::end(); ?>
</div>
