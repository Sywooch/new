<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Subcategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'old_id')->textInput() ?>

    <?= $form->field($model, 'old_cat_id')->textInput() ?>

    <?= $form->field($model, 'cat_id')->textInput() ?>

    <?= $form->field($model, 'subcat_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>