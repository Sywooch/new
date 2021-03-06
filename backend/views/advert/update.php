<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Advert */

$this->title = 'Update Advert: ' . $model->AdvertID;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->AdvertID, 'url' => ['view', 'id' => $model->AdvertID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="advert-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
