<?php

/* @var $this yii\web\View */
/* @var $user */

$advertLink = Yii::$app->urlManager->createAbsoluteUrl( [ 'adverts-views/details', 'id' => $id ] );
?>
Здравствуйте, <?= $user ?>!

Ваше объявление успешно добавлено!
Посмотреть его Вы можете по ссылке:

<?= $advertLink ?>
