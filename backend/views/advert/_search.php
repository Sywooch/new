<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdvertSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="advert-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'AdvertID') ?>

    <?= $form->field($model, 'AdvertsID') ?>

    <?= $form->field($model, 'AdvertFolder') ?>

    <?= $form->field($model, 'AdvertType') ?>

    <?= $form->field($model, 'AdvertHeader') ?>

    <?php // echo $form->field($model, 'AdvertComment') ?>

    <?php // echo $form->field($model, 'AdvertCity') ?>

    <?php // echo $form->field($model, 'AdvertPrice') ?>

    <?php // echo $form->field($model, 'AdvertCurrency') ?>

    <?php // echo $form->field($model, 'AdvertPeriod') ?>

    <?php // echo $form->field($model, 'AdvertTime') ?>

    <?php // echo $form->field($model, 'AdvertApproved') ?>

    <?php // echo $form->field($model, 'AdvertActive') ?>

    <?php // echo $form->field($model, 'AdvertPlaced') ?>

    <?php // echo $form->field($model, 'AdvertSelected') ?>

    <?php // echo $form->field($model, 'AdvertSelectedStart') ?>

    <?php // echo $form->field($model, 'AdvertSelectedDur') ?>

    <?php // echo $form->field($model, 'AdvertSpecial') ?>

    <?php // echo $form->field($model, 'AdvertSpecialStart') ?>

    <?php // echo $form->field($model, 'AdvertSpecialDur') ?>

    <?php // echo $form->field($model, 'AdvertImage1') ?>

    <?php // echo $form->field($model, 'AdvertImage2') ?>

    <?php // echo $form->field($model, 'AdvertImage3') ?>

    <?php // echo $form->field($model, 'AdvertImage4') ?>

    <?php // echo $form->field($model, 'AdvertImage5') ?>

    <?php // echo $form->field($model, 'AdvertImage6') ?>

    <?php // echo $form->field($model, 'AdvertUserID') ?>

    <?php // echo $form->field($model, 'AdvertUserName') ?>

    <?php // echo $form->field($model, 'AdvertUserEmail') ?>

    <?php // echo $form->field($model, 'AdvertUserPhone') ?>

    <?php // echo $form->field($model, 'AdvertUserICQ') ?>

    <?php // echo $form->field($model, 'AdvertUrl') ?>

    <?php // echo $form->field($model, 'AdvertRate') ?>

    <?php // echo $form->field($model, 'AdvertViewDay') ?>

    <?php // echo $form->field($model, 'AdvertViewWeek') ?>

    <?php // echo $form->field($model, 'AdvertViewMonth') ?>

    <?php // echo $form->field($model, 'AdvertIPAdress') ?>

    <?php // echo $form->field($model, 'AdvertIPProxyAdress') ?>

    <?php // echo $form->field($model, 'AdvertSendViaEmail') ?>

    <?php // echo $form->field($model, 'AdvertCustomValues') ?>

    <?php // echo $form->field($model, 'AdvertPass') ?>

    <?php // echo $form->field($model, 'AdvertImgDescription') ?>

    <?php // echo $form->field($model, 'AdvertAdvHash') ?>

    <?php // echo $form->field($model, 'AdvertTimeOriginated') ?>

    <?php // echo $form->field($model, 'AdvertSold') ?>

    <?php // echo $form->field($model, 'AdvertResponses') ?>

    <?php // echo $form->field($model, 'AdvertUserPhone2') ?>

    <?php // echo $form->field($model, 'AdvertAddress') ?>

    <?php // echo $form->field($model, 'AdvertUp') ?>

    <?php // echo $form->field($model, 'AdvertImg') ?>

    <?php // echo $form->field($model, 'AdvertEmailReal') ?>

    <?php // echo $form->field($model, 'exist_adv_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
