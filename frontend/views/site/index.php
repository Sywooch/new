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
//print Html::encode('<i class="fa fa-car" aria-hidden="true"></i>'); die;
//\common\models\Helpers::p( $dataProvider->getModels() ); die;
?>
<div class="site-index">

	<div class="row">
		<div class="col-xs-12">
			<form id="searchForm" class="form" action="/" method="post">

				<div class="form-group field-searchform-searchword has-success">

					<div class="input-group"><input type="text" id="searchform-searchword" class="form-control"
																					name="SearchForm[searchWord]" placeholder="Поиск объявления" autofocus=""
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
				<span class="pull-right">Всего в базе объявлений <strong class="text-primary">666</strong>, за месяц 444, за сутки
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
		<div class="col-sm-5">
			<h4>Последние добавленные объявления</h4>
		</div>

		<div class="col-sm-7 text-right">
			<div id="list-btn-a-link" class="btn-group" role="group" aria-label="...">
				<button id="ads-sort" type="button" class="btn btn-default"><i class="fa fa-sort"></i>Сортировать</button>
				<a id="list-btn-toggle-a" class="btn btn-default" href="javascript:void(0);"
					 title="Вывод объявлений списком"><i class="fa fa-th-list"></i></a>
				<a id="block-btn-toggle-a" class="btn btn-default" href="javascript:void(0);"
					 title="Вывод объявлений блоками"><i class="fa fa-th-large"></i></a>

				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
						<i class="fa fa-arrows-v" aria-hidden="true"></i>
						<span class="caret"></span>
					</button>
            <?php
            $values = [ 15, 25, 50, 75, 100 ];
            $current = $dataProvider->getPagination()->getPageSize();
            ?>
					<ul class="dropdown-menu">
              <?php foreach ( $values as $value ): ?>
								<li><a href="<?= Html::encode( Url::current( [ 'per-page' => $value ] ) ) ?>"><?= $value ?></a></li>
              <?php endforeach; ?>
					</ul>
				</div>

			</div>

		</div>
	</div>


	<div class="clearfix"></div>
	<div class="row">
		<div id="ads-sort-block" class="col-sm-12 collapse">
        <?= AdSort::widget(); ?>
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
