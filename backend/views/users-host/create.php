<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QAuthUser */

$this->title = 'Create Qauth User';
$this->params['breadcrumbs'][] = ['label' => 'Qauth Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qauth-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
