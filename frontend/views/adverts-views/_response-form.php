<?php
/* @var $images frontend\controllers\AdvertsController */
/* @var $responses \backend\models\Responses */

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\View;
use common\widgets\Alert;

?>

<div id="resp_mail" class="row">
	<div class="col-xs-12">
		<a class="btn btn-success pull-right" role="button" data-toggle="collapse" href="#response-ad"
			 aria-expanded="false" aria-controls="response-ad" title="Отправить письмо продавцу">Ответить на
			объявление&nbsp;&nbsp;<span
					class="caret"></span></a>
	</div>

	<div id="response-ad" class="col-xs-12 collapse">
		<?= Alert::widget() ?>
		<hr>
		<?php Pjax::begin( [
				'enablePushState' => false,
				'id'              => 'response-email'
		] ); ?>
		<?php $form = ActiveForm::begin( [
				'action'      => [ '/adverts-views/create-response', 'id' => $model->id ],
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

		<? if ( Yii::$app->user->isGuest ) {
			echo $form->field( $responses, 'verifyCode', [ 'enableAjaxValidation' => true ] )->widget( Captcha::className() );
		} ?>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<?= Html::submitButton( 'Отправить', [ 'class' => 'btn btn-primary' ] ) ?>
			</div>
		</div>

		<?php ActiveForm::end(); ?>
		<?php Pjax::end(); ?>
	</div>
</div>
<?php
$this->registerJs(
		'$("#response-email").on("pjax:end", function() {
	var form = $(document).find("#response-form");
	form.find("input, textarea").not(":button, :submit, :reset, :hidden").each(function(){
		$(this).val("");
	});
});', View::POS_READY );
?>
