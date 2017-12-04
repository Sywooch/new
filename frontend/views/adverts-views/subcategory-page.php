<?php
/**
 * File: subcategory-page.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:29
 */
use yii\widgets\LinkPager;

/* @var $provider frontend\controllers\AdvertsViewsController */

$this->params['breadcrumbs'][] = [ 'label' => Yii::$app->request->get( 'cat' ),
                                   'url'   => [
                                       'adverts-views/category-page',
                                       'id' => Yii::$app->request->get( 'catid' ),
																			 'cat' => Yii::$app->request->get( 'cat' )
                                   ]
];
$this->params['breadcrumbs'][] = Yii::$app->request->get( 'subcat' );
?>

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