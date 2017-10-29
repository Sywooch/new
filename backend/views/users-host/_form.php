<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QAuthUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qauth-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'QAuthUserEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserUserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserPassHash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserActivationHash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserGroupID')->textInput() ?>

    <?= $form->field($model, 'QAuthUserStatus')->textInput() ?>

    <?= $form->field($model, 'QAuthUserCreated')->textInput() ?>

    <?= $form->field($model, 'QAuthUserLastAuthDate')->textInput() ?>

    <?= $form->field($model, 'QAuthUserLastIP')->textInput() ?>

    <?= $form->field($model, 'QAuthUserFullName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserCompany')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserWebsite')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserZip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserICQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserSkype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserTwitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserLJ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QAuthUserDOB')->textInput() ?>

    <?= $form->field($model, 'QAuthUserGender')->textInput() ?>

    <?= $form->field($model, 'QAuthUserRating')->textInput() ?>

    <?= $form->field($model, 'QAuthUserAbout')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'QAuthUserExtra')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rights')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
