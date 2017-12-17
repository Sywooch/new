<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\FontAwesomeAsset;

AppAsset::register( $this );
FontAwesomeAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
	<title><?= Html::encode( Yii::$app->name ) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?= $this->render( '_navbartop', [] ); ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
          <?= Breadcrumbs::widget( [
              'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [],
          ] ) ?>
          <?= Alert::widget() ?>
          <?= $content ?>
			</div>
		</div>
	</div>
</div>

<?= $this->render( 'footer' ) ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
