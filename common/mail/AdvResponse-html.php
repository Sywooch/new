<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $adverts \board\entities\Adverts */
/* @var $responses \frontend\models\Responses */

$advertLink = Yii::$app->urlManager->createAbsoluteUrl( [ 'adverts-views/details', 'id' => $responses->ad_id ] );
?>
<div class="password-reset">
	<p>Здравствуйте, <?= $adverts->author ?>!</p>

	<p>На Ваше объявление <?= $adverts->header ?>, ID: <?= Html::a( Html::encode( $advertLink ), $advertLink ) ?> поступил
		ответ.</p>
	<p><?= $responses->message ?></p>
    <?php
    if ( !null == $responses->name ) { ?>
			<p>Отправитель: <?= $responses->name ?></p>
    <?php } ?>
	<p>Email отправителя: <?= $responses->email ?></p>
    <?php
    if ( !null == $responses->phone ) {
        ?>
			<p>Телефон: <?= $responses->phone ?></p>
    <?php } ?>
</div>