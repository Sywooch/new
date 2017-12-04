<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Periods */

$this->title = 'Create Periods';
$this->params['breadcrumbs'][] = ['label' => 'Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
