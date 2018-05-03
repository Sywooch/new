<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Responses */

$this->title = 'Update Responses: {nameAttribute}';
$this->params['breadcrumbs'][] = [ 'label' => 'Responses', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->name, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="responses-update">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form', [
			'model' => $model,
	] ) ?>

</div>
