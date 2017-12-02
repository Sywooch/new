<?php
use frontend\assets\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use board\repositories\AdvertsRepository;
use frontend\widgets\menu12btns\Menu12Btns;

/* @var $this yii\web\View */
FontAwesomeAsset::register( $this );
$this->title = 'vezugruz29.ru';

//\common\models\Helpers::p( $dataProvider->getModels() ); die;
?>
<div class="site-index">

	<div class="row">
		<div class="col-xs-12">
			<form id="searchForm" class="form" action="/" method="post">
				<input type="hidden" name="_csrf-frontend" value="OTctbkpoMHcBZUgLJC1RGm5ASD8rXkBGAGZBHwlZcihPfABXHDBvBg==">
				<div class="form-group field-searchform-qact">

					<input type="hidden" id="searchform-qact" class="form-control" name="SearchForm[qact]"
								 options="{&quot;value&quot;:&quot;search_adv&quot;}">


				</div>
				<div class="form-group field-searchform-sortby">

					<input type="hidden" id="searchform-sortby" class="form-control" name="SearchForm[SortBy]"
								 options="{&quot;value&quot;:&quot;Time&quot;}">


				</div>
				<div class="form-group field-searchform-dir">

					<input type="hidden" id="searchform-dir" class="form-control" name="SearchForm[Dir]"
								 option="{&quot;value&quot;:&quot;d&quot;}">


				</div>
				<div class="form-group field-searchform-city">

					<input type="hidden" id="searchform-city" class="form-control" name="SearchForm[City]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-folder">

					<input type="hidden" id="searchform-folder" class="form-control" name="SearchForm[Folder]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-type">

					<input type="hidden" id="searchform-type" class="form-control" name="SearchForm[Type]"
								 option="{&quot;value&quot;:&quot;-1&quot;}">


				</div>
				<div class="form-group field-searchform-price_start">

					<input type="hidden" id="searchform-price_start" class="form-control" name="SearchForm[Price_Start]"
								 option="{&quot;value&quot;:&quot;&quot;}">


				</div>
				<div class="form-group field-searchform-price_end">

					<input type="hidden" id="searchform-price_end" class="form-control" name="SearchForm[Price_End]"
								 option="{&quot;value&quot;:&quot;&quot;}">


				</div>
				<div class="form-group field-searchform-currency">

					<input type="hidden" id="searchform-currency" class="form-control" name="SearchForm[Currency]"
								 option="{&quot;value&quot;:&quot;1&quot;}">


				</div>
				<div class="form-group field-searchform-period">

					<input type="hidden" id="searchform-period" class="form-control" name="SearchForm[Period]"
								 option="{&quot;value&quot;:&quot;3000&quot;}">


				</div>
				<div class="form-group field-searchform-owneradvid">

					<input type="hidden" id="searchform-owneradvid" class="form-control" name="SearchForm[OwnerAdvID]"
								 option="{&quot;value&quot;:&quot;0&quot;}">


				</div>
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
      <?= Menu12Btns::widget(); ?>
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

	<div id="ads-sort-block" class="col-sm-12 collapse">
		<div class="panel panel-default">
			<div class="panel-body">

          <?php $form = ActiveForm::begin( [
              'options' => [ 'action' => '/site/index', 'class' => 'form-horizontal' ]
          ] ); ?>

          <?= Html::hiddenInput( 'form_action', 'ads_sort' ) ?>

				<div class="form-group">
            <?/*= $form->field( $model, 'country' )->dropDownList( AdvertsRepository::countryList(), [ 'prompt' => 'Выберите' ] ) */?>

					<div class="col-sm-3">
						<div id="date-sort">
							По дате&nbsp;&nbsp;
                <?= Html::hiddenInput( 'date_sort', '', [ 'id' => 'date' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-up" aria-hidden="true"></i>',
                    [ 'data-id' => 2, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-down" aria-hidden="true"></i>',
                    [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
						</div>
					</div>

					<div class="col-sm-3">
						<div id="price-sort">
							По цене&nbsp;&nbsp;
                <?= Html::hiddenInput( 'price_sort', '', [ 'id' => 'price' ] ) ?>

                <?= Html::button( '<i class="fa fa-angle-up" aria-hidden="true"></i>',
                    [ 'data-id' => 2, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
                <?= Html::button( '<i class="fa fa-angle-down" aria-hidden="true"></i>',
                    [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-3 hide">
              <?= Html::checkbox( 'img_only', true, [ 'label' => false, 'id' => 'img-only' ] ) ?>
						Только с фотографиями
					</div>
					<div class="col-sm-offset-6 col-sm-3">
              <?= Html::checkbox( 'save_sort', true,
                  [ 'label' => false, 'id' => 'save-sort', 'checked' => 'checked' ] ) ?>
						Сохранить сортировку
					</div>
					<div class="col-sm-3">
              <?= Html::submitButton( 'Сортировать', [ 'class' => 'btn btn-success btn-sm' ] ) ?>
              <?= Html::resetButton( 'Сбросить', [ 'class' => 'btn btn-default btn-sm' ] ) ?>
					</div>
				</div>

				<div class="clearfix"></div>

          <?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<hr>
		</div>
      <?php foreach ( $dataProvider->getModels() as $model ) { ?>
          <?= $this->render( '_single_adv', [
              'model' => $model
          ] ) ?>
      <?php } ?>

	</div>
	<div class="row">
		<div class="col-sx-12">
        <?= LinkPager::widget( [
//            'pagination' => $pages,
'pagination' => $dataProvider->getPagination(),
        ] ) ?>
		</div>
	</div>
</div>
