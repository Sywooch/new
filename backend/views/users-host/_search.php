<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QAuthUserSearc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qauth-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'QAuthUserID') ?>

    <?= $form->field($model, 'QAuthUserEmail') ?>

    <?= $form->field($model, 'QAuthUserUserName') ?>

    <?= $form->field($model, 'QAuthUserPassHash') ?>

    <?= $form->field($model, 'QAuthUserActivationHash') ?>

    <?php // echo $form->field($model, 'QAuthUserGroupID') ?>

    <?php // echo $form->field($model, 'QAuthUserStatus') ?>

    <?php // echo $form->field($model, 'QAuthUserCreated') ?>

    <?php // echo $form->field($model, 'QAuthUserLastAuthDate') ?>

    <?php // echo $form->field($model, 'QAuthUserLastIP') ?>

    <?php // echo $form->field($model, 'QAuthUserFullName') ?>

    <?php // echo $form->field($model, 'QAuthUserCompany') ?>

    <?php // echo $form->field($model, 'QAuthUserWebsite') ?>

    <?php // echo $form->field($model, 'QAuthUserPhone') ?>

    <?php // echo $form->field($model, 'QAuthUserCity') ?>

    <?php // echo $form->field($model, 'QAuthUserAddress') ?>

    <?php // echo $form->field($model, 'QAuthUserZip') ?>

    <?php // echo $form->field($model, 'QAuthUserICQ') ?>

    <?php // echo $form->field($model, 'QAuthUserSkype') ?>

    <?php // echo $form->field($model, 'QAuthUserTwitter') ?>

    <?php // echo $form->field($model, 'QAuthUserLJ') ?>

    <?php // echo $form->field($model, 'QAuthUserDOB') ?>

    <?php // echo $form->field($model, 'QAuthUserGender') ?>

    <?php // echo $form->field($model, 'QAuthUserRating') ?>

    <?php // echo $form->field($model, 'QAuthUserAbout') ?>

    <?php // echo $form->field($model, 'QAuthUserExtra') ?>

    <?php // echo $form->field($model, 'rights') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
