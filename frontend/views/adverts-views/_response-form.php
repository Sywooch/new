<?php
/* @var $images frontend\controllers\AdvertsController */
/* @var $responses \frontend\models\Responses */
/* @var $status \frontend\models\Responses */
/* @var $messages \frontend\models\Responses */
/* @var $model \board\entities\Adverts */
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\View;
use common\widgets\Alert;

?>

<div id="response-ad" class="col-xs-12 collapse">
	<hr>
    <?php Pjax::begin( [
        'enablePushState' => false,
        'id'              => 'response-email'
    ] ); ?>

    <?php if ( $status !== null && $messages !== null ): ?>
			<div class="alert alert-<?= $status ?> alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
							aria-hidden="true">&times;</span></button>
          <?= $messages ?>
			</div>
    <?php endif; ?>

    <?php $form = ActiveForm::begin( [
				'action'      => [ '/responses/create-response', 'id' => $model->id ],
				'method'      => 'post',
				'id'          => 'response-form',
				'options'     => [
            'data-pjax' => true,
            'class'     => 'form-horizontal',
        ],
				'fieldConfig' => [
            'template'     => '{label}<div class="col-sm-9 col-xs-12">{input}</div><div class="col-sm-offset-3 col-sm-9 col-xs-10">{error}</div>',
            'labelOptions' => [ 'class' => 'col-sm-3 col-xs-12 control-label' ],
        ],
    ] )
    ?>

    <?= $form->field( $responses, 'name' )->textInput( [ 'maxlength' => true, ] ) ?>

    <?= $form->field( $responses, 'email' )->textInput( [ 'maxlength' => true, ] ) ?>

    <?= $form->field( $responses, 'phone' )->textInput( [ 'maxlength' => true, ] ) ?>

    <?= $form->field( $responses, 'message' )->textarea( [ 'rows' => 4, 'cols' => 30 ] ) ?>

    <? if ( true ) {
			echo $form->field( $responses, 'verifyCode' )->widget( Captcha::className() );
    } ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-6">
        <?= Html::submitButton( 'Отправить', [ 'class' => 'btn btn-primary' ] ) ?>
		</div>
	</div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>
