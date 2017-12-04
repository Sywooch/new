<?php
/**
 * File: index.php
 * Email: becksonq@gmail.com
 * Date: 03.12.2017
 * Time: 11:54
 */
use yii\helpers\Html;
use board\repositories\AdvertsRepository;

?>
<div class="panel panel-default">
	<div class="panel-body">

      <?= Html::beginForm( [
          '/site/index'
      ],
          'post', [
              'class' => 'form-horizontal'
          ] ) ?>

      <?= Html::hiddenInput( 'form_action', 'ads_sort' ) ?>

		<div class="form-group">
			<div id="city-sort" class="col-sm-3">
          <?= Html::dropDownList( 'city_sort', -1, AdvertsRepository::countryList(),
              [ 'class' => 'form-control', 'prompt' => 'Расположение' ] ) ?>
			</div>

			<div class="col-sm-3">
				<div id="type-sort">
            <?= Html::dropDownList( 'type_sort', -1, AdvertsRepository::typeList(),
                [ 'class' => 'form-control', 'prompt' => 'Тип' ] ) ?>
				</div>
			</div>

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

      <?= Html::endForm() ?>

	</div>
</div>
