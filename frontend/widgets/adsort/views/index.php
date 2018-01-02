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
				<div id="city-sort" class="col-sm-3">
            <?= Html::dropDownList( 'city_sort', -1, AdvertsRepository::countryList(),
                [ 'class' => 'form-control', 'prompt' => 'По расположению' ] ) ?>
				</div>

				<div id="type-sort" class="col-sm-3">
            <?= Html::dropDownList( 'type_sort', -1, AdvertsRepository::typeList(),
                [ 'class' => 'form-control', 'prompt' => 'По типу' ] ) ?>
				</div>

				<div id="date-sort" class="col-sm-3">
					По дате&nbsp;&nbsp;
            <?= Html::hiddenInput( 'date_sort', '', [ 'id' => 'date' ] ) ?>
            <?= Html::button( '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>',
                [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
            <?= Html::button( '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>',
                [ 'data-id' => 0, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
				</div>

				<div id="price-sort" class="col-sm-3">
					По цене&nbsp;&nbsp;
            <?= Html::hiddenInput( 'sort', '', [ 'id' => 'price' ] ) ?>
            <?= Html::button( '<i class="fa fa-long-arrow-up" aria-hidden="true"></i>',
                [ 'data-id' => 1, 'class' => 'btn btn-default btn-sm', 'title' => 'По возрастанию' ] ) ?>
            <?= Html::button( '<i class="fa fa-long-arrow-down" aria-hidden="true"></i>',
                [ 'data-id' => 0, 'class' => 'btn btn-default btn-sm', 'title' => 'По убыванию' ] ) ?>
				</div>
			</div>
			<div class="clearfix"></div>

			<div class="form-group">
				<div id="category-sort" class="col-sm-3">
            <?= Html::dropDownList( 'category_sort', '', AdvertsRepository::categoryList(),
                [ 'class' => 'form-control', 'prompt' => 'По категории' ] ) ?>
				</div>

				<div id="subcategory-sort" class="col-sm-3">
            <?= Html::dropDownList( 'subcategory_sort', '', [],
                [ 'class' => 'form-control', 'disabled' => 'disabled', 'prompt' => 'По подкатегории' ] ) ?>
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
