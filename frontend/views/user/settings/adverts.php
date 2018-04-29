<?php
/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\SettingsForm $model
 * @var $dataProvider frontend\controllers\user\SettingsController
 */

$this->title = Yii::t( 'user', 'Мои объявления' );
$this->params['breadcrumbs'][] = $this->title;
?>

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
