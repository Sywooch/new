<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="adverts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'old_id') ?>

    <?= $form->field($model, 'sid') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'subcat_id') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'header') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'selected') ?>

    <?php // echo $form->field($model, 'special') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
