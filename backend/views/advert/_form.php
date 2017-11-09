<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Advert */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AdvertsID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertFolder')->textInput() ?>

    <?= $form->field($model, 'AdvertType')->textInput() ?>

    <?= $form->field($model, 'AdvertHeader')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertComment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertCity')->textInput() ?>

    <?= $form->field($model, 'AdvertPrice')->textInput() ?>

    <?= $form->field($model, 'AdvertCurrency')->textInput() ?>

    <?= $form->field($model, 'AdvertPeriod')->textInput() ?>

    <?= $form->field($model, 'AdvertTime')->textInput() ?>

    <?= $form->field($model, 'AdvertApproved')->textInput() ?>

    <?= $form->field($model, 'AdvertActive')->textInput() ?>

    <?= $form->field($model, 'AdvertPlaced')->textInput() ?>

    <?= $form->field($model, 'AdvertSelected')->textInput() ?>

    <?= $form->field($model, 'AdvertSelectedStart')->textInput() ?>

    <?= $form->field($model, 'AdvertSelectedDur')->textInput() ?>

    <?= $form->field($model, 'AdvertSpecial')->textInput() ?>

    <?= $form->field($model, 'AdvertSpecialStart')->textInput() ?>

    <?= $form->field($model, 'AdvertSpecialDur')->textInput() ?>

    <?= $form->field($model, 'AdvertImage1')->textInput() ?>

    <?= $form->field($model, 'AdvertImage2')->textInput() ?>

    <?= $form->field($model, 'AdvertImage3')->textInput() ?>

    <?= $form->field($model, 'AdvertImage4')->textInput() ?>

    <?= $form->field($model, 'AdvertImage5')->textInput() ?>

    <?= $form->field($model, 'AdvertImage6')->textInput() ?>

    <?= $form->field($model, 'AdvertUserID')->textInput() ?>

    <?= $form->field($model, 'AdvertUserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertUserEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertUserPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertUserICQ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertRate')->textInput() ?>

    <?= $form->field($model, 'AdvertViewDay')->textInput() ?>

    <?= $form->field($model, 'AdvertViewWeek')->textInput() ?>

    <?= $form->field($model, 'AdvertViewMonth')->textInput() ?>

    <?= $form->field($model, 'AdvertIPAdress')->textInput() ?>

    <?= $form->field($model, 'AdvertIPProxyAdress')->textInput() ?>

    <?= $form->field($model, 'AdvertSendViaEmail')->textInput() ?>

    <?= $form->field($model, 'AdvertCustomValues')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertPass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertImgDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertAdvHash')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertTimeOriginated')->textInput() ?>

    <?= $form->field($model, 'AdvertSold')->textInput() ?>

    <?= $form->field($model, 'AdvertResponses')->textInput() ?>

    <?= $form->field($model, 'AdvertUserPhone2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AdvertAddress')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'AdvertUp')->textInput() ?>

    <?= $form->field($model, 'AdvertImg')->textInput() ?>

    <?= $form->field($model, 'AdvertEmailReal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exist_adv_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
