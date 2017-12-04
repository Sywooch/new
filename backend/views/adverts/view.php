<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Adverts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'old_id',
            'sid',
            'cat_id',
            'subcat_id',
            'type',
            'header',
            'description:ntext',
            'country',
            'period',
            'author',
            'email:email',
            'active',
            'selected',
            'selected_old',
            'special',
            'special_old',
            'images_old',
            'ip',
            'created_at',
            'updated_at',
            'draft',
        ],
    ]) ?>

</div>
