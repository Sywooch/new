<?php
/**
 * File: subcategory-page.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:29
 */
use frontend\widgets\submenu\SubmenuTabs;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\FontAwesomeAsset;

FontAwesomeAsset::register( $this );
/* @var $provider frontend\controllers\AdvertsViewsController */

$this->params['breadcrumbs'][] = Yii::$app->request->get('cat');
//echo $sort->link('header');
?>

<div class="row">
	<div class="col-sm-12 col-xs-12">
      <?= SubmenuTabs::widget(); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-offset-7 col-sm-5 col-xs-12">
		<div class="form-group input-group input-group">
			<label class="input-group-addon" for="input-sort"><i class="fa fa-filter" aria-hidden="true"></i>Фильтр:</label>
			<select id="input-sort" class="form-control" onchange="location = this.value;">
          <?php
          $values = [
              ''        => 'По умолчанию',
              'header'  => 'По алфавиту (А - Я)',
              '-header' => 'По алфавиту (Я - А)',
              'subcat'  => 'По подкатегории (А - Я)',
              '-subcat' => 'По подкатегории (Я - А)',
              'price'   => 'По цене (+)',
              '-price'  => 'По цене (-)',
              '-type'   => 'По типу',
              'type'    => 'По типу',
          ];
          $current = Yii::$app->request->get( 'sort' );
          ?>
          <?php foreach ( $values as $value => $label ): ?>
						<option value="<?= Html::encode( Url::current( [ 'sort' => $value ? : null ] ) ) ?>"
                    <?php if ( $current == $value ): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
          <?php endforeach; ?>
			</select>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12 col-sx-12">
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