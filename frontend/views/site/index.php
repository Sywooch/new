<?php
use frontend\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use frontend\widgets\catmenu\CatmenuTabs;
use frontend\widgets\adsort\AdSort;

/* @var $this yii\web\View */
FontAwesomeAsset::register( $this );
$this->title = 'vezugruz29.ru';
//\common\models\Helpers::p( count($dataProvider->getModels()), 1 ); die;
?>
<div class="site-index">

	<div class="row">
		<div class="col-xs-12">
			<form id="searchForm" class="form" action="/" method="post">

				<div class="form-group field-searchform-searchword has-success">

					<div class="input-group"><input type="text" id="searchform-searchword" class="form-control"
																					name="SearchForm[searchWord]" placeholder="Поиск объявления"
																					style="" aria-invalid="false"><span class="input-group-btn"><button
									id="sub-btn-search" class="btn btn-primary" type="button">Найти</button></span></div>

					<p class="help-block help-block-error"></p>
				</div>
			</form>

			<p class="help-block">
				Пример: nokia&nbsp;&nbsp;
				<b><a id="ext-search-link" href="javascript:void();"><i class="fa fa-search-plus"></i>&nbsp;&nbsp;Расширенный
						поиск</a></b>
				<!-- Статистика объявлений -->
				<span class="pull-right">Всего в базе объявлений <strong class="text-primary"><?= $dataProvider->totalCount ?></strong>, за месяц 444, за сутки
	333</span>
			</p></div>
	</div>

	<div class="row">
		<div class="col-xs-12">
        <?= CatmenuTabs::widget(); ?>
		</div>
	</div>

	<br>

	<div id="sort-site-index" class="row">
		<div class="col-sm-7 col-xs-12">
			<h4>Последние добавленные объявления</h4>
		</div>

		<div class="col-sm-5 col-xs-12">

			<div class="input-group pull-right">

				<span class="input-group-btn">
					<button id="ads-sort" type="button" class="btn btn-default"><i class="fa fa-sort"></i>Сортировать</button>
				  <a id="list-btn-toggle-a" class="btn btn-default" href="javascript:void(0);" title="Вывод объявлений списком"><i class="fa fa-th-list"></i></a>
				  <a id="block-btn-toggle-a" class="btn btn-default" href="javascript:void(0);" title="Вывод объявлений блоками"><i class="fa fa-th-large"></i></a>
				</span>

				<select id="input-limit" class="form-control" onchange="location = this.value;">
            <?php
            $values = [ 15, 25, 50, 75, 100 ];
            $current = $dataProvider->getPagination()->getPageSize();
            ?>
            <?php foreach ( $values as $value ): ?>
							<option value="<?= Html::encode( Url::current( [ 'per-page' => $value ] ) ) ?>"
                      <?php if ( $current == $value ): ?>selected="selected"<?php endif; ?>><?= $value ?></option>
            <?php endforeach; ?>
				</select>

			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="row">
		<div id="ads-sort-block" class="col-sm-12 collapse">
        <?= AdSort::widget(['action' => 'site/index']); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<hr>
		</div>
      <?php foreach ( $dataProvider->getModels() as $model ) { ?>
          <?= $this->render( Yii::getAlias( '@web' ) . '/adverts-views/_single_adv', [
              'model' => $model
          ] ) ?>
      <?php } ?>

	</div>
	<div class="row">
		<div class="col-xs-12">
        <?= LinkPager::widget( [
            'pagination' => $dataProvider->getPagination(),
        ] ) ?>
		</div>
	</div>
</div>
