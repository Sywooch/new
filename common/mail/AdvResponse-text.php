<?php
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $adverts \board\entities\Adverts */
/* @var $responses \frontend\models\Responses */

$advertLink = Yii::$app->urlManager->createAbsoluteUrl( [ 'adverts-views/details', 'id' => $responses->ad_id ] );
?>
Здравствуйте, <?= $adverts->author ?>!

На Ваше объявление <?= $adverts->header ?>, ID: <?= Html::a( Html::encode( $advertLink ), $advertLink ) ?> поступил
ответ.
<?= $responses->message ?>
<?php
if ( !null == $responses->name ) { ?>
	Отправитель: <?= $responses->name ?>
<?php } ?>
Email отправителя: <?= $responses->email ?>
<?php
if ( !null == $responses->phone ) {
    ?>
	Телефон: <?= $responses->phone ?>
<?php } ?>
