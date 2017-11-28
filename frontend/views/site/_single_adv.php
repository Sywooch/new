<?php
/**
 * File: _single_advert.php
 * Email: becksonq@gmail.com
 * Date: 26.11.2017
 * Time: 22:04
 */
use yii\helpers\Html;

//\common\models\Helpers::p( $model->type );
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
				<a href="<?= Yii::$app->urlManager->createUrl( [
            'adverts/view-single',
            'id' => $model['id']
        ] ); ?>">
					<h5><?= $model->header ?></h5>
				</a>
				<p>
					<small>
				<span>06.03.2017
                    &nbsp;&nbsp;&nbsp;<span>
						<i class="fa fa-map-marker"></i>
						г. Каргополь</span>,
					&nbsp;&nbsp;&nbsp;
					<i class="fa fa-folder-open"></i>
                     Хобби и отдых / Животные и растения
				</span>
					</small>
				</p>

				<p class="price">500 руб.</p>
			</div>

			<div class="pull-right data-extra">

				<ul class="list-inline">

					<li title="Количество фотографий">
						<i class="fa fa-file-image-o"></i>
						<span class="badge"></span>
					</li>
					<li>Коротко:
						<a href="javascript:void(0);" data-container="body" data-toggle="popover" animation="true"data-placement="top" data-content="<?= \common\models\Helpers::getShortComment( $model->description, 140 ); ?>" data-original-title="" title="" style="z-index: -222;">
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


