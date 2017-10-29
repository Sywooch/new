<?php
/**
 * File: dashboard.php
 * Email: becksonq@gmail.com
 * Date: 29.10.2017
 * Time: 19:24
 */

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register( $this );
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
        [ 'label' => 'Home', 'url' => [ '/site/index' ] ],
    ];
    if ( Yii::$app->user->isGuest ) {
        $menuItems[] = [ 'label' => 'Login', 'url' => [ '/user/security/login' ] ];
    }
    else {
        $menuItems[] = '<li>'
            . Html::beginForm( [ '/site/logout' ], 'post' )
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

    <div class="container-fluid">
        <?= $this->render( '_sidebar' ); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?= Breadcrumbs::widget( [
                'homeLink' => [ 'label' => 'Главная', 'url' => '/site/index' ],
                'links'    => isset( $this->params['breadcrumbs'] ) ? $this->params['breadcrumbs'] : [],
            ] ) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
