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
    <?php
    NavBar::begin( [
        'brandLabel' => Yii::$app->name,
        'brandUrl'   => Yii::$app->homeUrl,
        'options'    => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ] );
    $menuItems = [
        [ 'label' => 'Главная', 'url' => [ '/site/index' ] ],
        [ 'label' => 'О нас', 'url' => [ '/site/about' ] ],
        [ 'label' => 'Контакты', 'url' => [ '/site/contact' ] ],
    ];
    if ( Yii::$app->user->isGuest ) {
        $menuItems[] = [ 'label' => 'Регистрация', 'url' => [ '/user/registration/register' ] ];
        $menuItems[] = [ 'label' => 'Вход', 'url' => [ '/user/security/login' ] ];
    }
    else {
        $menuItems[] = '<li>'
            . Html::beginForm( [ '/user/security/logout' ], 'post' )
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                [ 'class' => 'btn btn-link logout' ]
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget( [
        'options' => [ 'class' => 'navbar-nav navbar-right' ],
        'items'   => $menuItems,
    ] );
    NavBar::end();
    ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-xs-12">
          <?= Breadcrumbs::widget( [
              'links' => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [],
          ] ) ?>
          <?= Alert::widget() ?>
          <?= $content ?>
			</div>

			<div class="col-sm-3">
				<!--<button id="add-ads-main-red" class="btn btn-lg btn-danger btn-block"><i class="fa fa-pencil-square-o"></i>
					Подать объявление
				</button>-->

          <?= Html::a('<i class="fa fa-pencil-square-o"></i>Подать объявление', ['/adverts/create'], ['id' => 'add-ads-main-red', 'class'=>'btn btn-lg btn-danger btn-block', 'type' => 'button']) ?>

			</div>
		</div>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date( 'Y' ) ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
