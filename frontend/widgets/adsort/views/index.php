<?php
/**
 * File: index.php
 * Email: becksonq@gmail.com
 * Date: 03.12.2017
 * Time: 11:54
 */
use yii\helpers\Html;
use yii\helpers\Url;
use board\repositories\AdvertsRepository;
use frontend\widgets\adsort\AdvSortAsset;

AdvSortAsset::register( $this );
?>

<div id="ads-sort-block" class="col-sm-12 collapse">
	<div class="panel panel-default">
		<div class="panel-body">

        <?= Html::beginForm( Url::to(['site/index']), 'post', [ 'class' => 'form-horizontal' ] ) ?>

			<div class="form-group">
				<div class="col-sm-3">
            <?= Html::dropDownList( 'city_sort', '', AdvertsRepository::countryList(),
                [ 'id' => 'city-sort', 'class' => 'form-control', 'prompt' => 'По расположению' ] ) ?>
				</div>

				<div id="type-sort" class="col-sm-3">
            <?= Html::dropDownList( 'type_sort', '', AdvertsRepository::typeList(),
                [ 'class' => 'form-control', 'prompt' => 'По типу' ] ) ?>
				</div>

				<div class="col-sm-3">
            <?= Html::dropDownList( 'date_sort', '', AdvertsRepository::dateList(),
                [ 'id' => 'date-sort', 'class' => 'form-control', 'prompt' => 'По дате' ] ) ?>
				</div>

				<div class="col-sm-3">
            <?= Html::dropDownList( 'price_sort', '', AdvertsRepository::priceList(),
                [ 'id' => 'price-sort', 'class' => 'form-control', 'prompt' => 'По цене' ] ) ?>
				</div>

			</div>
			<div class="clearfix"></div>

			<div class="form-group">
				<div class="col-sm-3">
            <?= Html::dropDownList( 'category_sort', '', AdvertsRepository::categoryList(),
                [ 'id' => 'category-sort', 'class' => 'form-control', 'prompt' => 'По категории' ] ) ?>
				</div>

				<div class="col-sm-3">
            <?= Html::dropDownList( 'subcategory_sort', '', [],
                [ 'id' => 'subcategory-sort', 'class' => 'form-control', 'disabled' => 'disabled', 'prompt' => 'По подкатегории' ] ) ?>
				</div>

				<div class="col-sm-3">
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

        <?= Html::endForm() ?>

		</div>
	</div>
</div>
