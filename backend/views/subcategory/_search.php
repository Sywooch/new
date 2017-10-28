<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SubcategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'old_id') ?>

    <?= $form->field($model, 'old_cat_id') ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'subcat_name') ?>

    <?php // echo $form->field($model, 'menu_order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
