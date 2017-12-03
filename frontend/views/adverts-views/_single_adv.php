<?php
/**
 * File: _single_advert.php
 * Email: becksonq@gmail.com
 * Date: 26.11.2017
 * Time: 22:04
 */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model frontend\controllers\AdvertsViewsController */
//\common\models\Helpers::p( $model ); die;
?>

<div class="ad-list col-xs-12">
	<div class="ad-thumb">
		<div class="image">
			<a href="https://demo.opencart.com/index.php?route=product/product&amp;path=25_28&amp;product_id=42">
				<img src="https://demo.opencart.com/image/cache/catalog/demo/apple_cinema_30-228x228.jpg"
						 alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;" class="img-responsive" width="140">
			</a>
		</div>

		<div>
			<div class="caption">
				<a href="<?= Url::to( [
            'adverts-views/details',
            'id' => $model->id
        ] ); ?>">
					<h5><?= $model->header ?></h5>
				</a>
				<p>
					<small><span><?= Yii::$app->formatter->asDatetime( $model->created_at, Yii::$app->params['dateFormat'] ); ?>
							<span>
						<i class="fa fa-map-marker"></i><?= $model->countries->country_name ?></span>,
					&nbsp;&nbsp;&nbsp;
					<i class="fa fa-folder-open"></i><?= $model->category->category_name ?>
							&nbsp;/&nbsp;<?= $model->subcategory->subcat_name ?></span>
					</small>
				</p>

				<p class="price"><?= $model->pricies->price ?>&nbsp;<?= $model->pricies->currencies->short_name ?>.</p>
			</div>

			<div class="pull-right data-extra">

				<ul class="list-inline">

					<li title="Количество фотографий">
						<i class="fa fa-file-image-o"></i>
						<span class="badge"></span>
					</li>
					<li>Коротко:
						<a href="javascript:void(0);" data-container="body" data-toggle="popover" animation="true"
							 data-placement="top"
							 data-content="<?= \common\models\Helpers::getShortComment( $model->description, 140 ); ?>"
							 data-original-title="" title="" style="z-index: -222;">
							<i class="fa fa-align-left"></i>
						</a>
					</li>
					<li class="adv-type">
						Тип:&nbsp;<strong><span><?= $model->type->name ?></span></strong>
					</li>
					<li>Просмотров:&nbsp;<span class="badge">1</span></li>
				</ul>

			</div>
		</div>

	</div>
</div>


