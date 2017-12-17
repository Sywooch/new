<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 */

$this->title = Yii::t( 'user', 'My Adverts' );
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render( '/_alert', [ 'module' => Yii::$app->getModule( 'user' ) ] ) ?>

<div class="row">
	<div class="col-md-3">
      <?= $this->render( '_menu' ) ?>
	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-xs-12">
				<hr>
			</div>
        <?php foreach ( $dataProvider->getModels() as $model ) { ?>
            <?= $this->render( '_single_adv', [
                'model' => $model
            ] ) ?>
        <?php } ?>
		</div>
	</div>
</div>
