<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user */

$advertLink = Yii::$app->urlManager->createAbsoluteUrl( [ 'adverts-views/details', 'id' => $id ] );
?>
<div class="password-reset">
	<p>Здравствуйте, <?= $user ?>!</p>

	<p>Ваше объявление успешно добавлено!</p>
	<p>Посмотреть его Вы можете по ссылке:</p>

	<p><?= Html::a( Html::encode( $advertLink ), $advertLink ) ?></p>
</div>