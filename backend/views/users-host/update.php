<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\QAuthUser */

$this->title = 'Update Qauth User: ' . $model->QAuthUserID;
$this->params['breadcrumbs'][] = ['label' => 'Qauth Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->QAuthUserID, 'url' => ['view', 'id' => $model->QAuthUserID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qauth-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
