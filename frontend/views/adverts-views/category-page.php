<?php
/**
 * File: subcategory-page.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:29
 */
use frontend\widgets\submenu\SubmenuTabs;
use yii\widgets\LinkPager;
use frontend\assets\FontAwesomeAsset;

/* @var $provider frontend\controllers\AdvertsViewsController */

FontAwesomeAsset::register( $this );

$this->params['breadcrumbs'][] = Yii::$app->request->get('cat');
?>

<div class="row">
	<div class="col-xs-12">
      <?= SubmenuTabs::widget(); ?>
	</div>
</div>

<div class="row">
	<div class="col-sx-12">
		<hr>
	</div>
    <?php foreach ( $provider->getModels() as $model ) { ?>
        <?= $this->render( '_single_adv', [
            'model' => $model
        ] ) ?>
    <?php } ?>
</div>

<div class="row">
	<div class="col-sx-12">
      <?= LinkPager::widget( [
          'pagination' => $provider->getPagination(),
      ] ) ?>
	</div>
</div>