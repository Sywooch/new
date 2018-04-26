<?php
/**
 * File: _single_advert.php
 * Email: becksonq@gmail.com
 * Date: 26.11.2017
 * Time: 22:04
 */
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Helpers;

/* @var $model frontend\controllers\AdvertsViewsController */
?>

<div class="ad-list col-xs-12">
	<div class="ad-thumb">
		<div class="image">
			<div class="row">
				<div class="col-sm-offset-0 col-sm-12 col-xs-offset-3 col-xs-6">
            <?php
            if ( $model->has_images ) {

                echo Html::img( '@web/img/temp/' . $model->images[0]->sid . '/' . $model->images[0]->filename,
                    [ 'class' => 'thumbnail' ] );

             } else { ?>

							<div class="blank-img">
								<i class="fa fa-camera fa-2x" aria-hidden="true"></i>
							</div>

					<?php } ?>

				</div>
			</div>
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
					<small><i class="fa fa-calendar" aria-hidden="true"></i>
							<?= Yii::$app->formatter->asDatetime( $model->created_at, Yii::$app->params['dateFormat'] ); ?>
						<br>
						<i class="fa fa-map-marker" aria-hidden="true"></i><?= $model->country->country_name ?>
						<i class="fa fa-folder-open" aria-hidden="true"></i><?= $model->category->category_name ?>
						&nbsp;/&nbsp;<?= $model->subcategory->subcat_name ?>
					</small>
				</p>

				<p class="price"><?= Yii::$app->formatter->asInteger( $model->price->price_value ) ?>
					&nbsp;<?= $model->price->currency->short_name ?></p>
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
							 data-content="<?= Helpers::getShortComment( $model->description, 140 ); ?>"
							 data-original-title="" title="" style="z-index: -222;">
							<i class="fa fa-align-left"></i>
						</a>
					</li>
					<li class="adv-type">
						Тип:&nbsp;<strong><span><?= $model->type->name ?></span></strong>
					</li>
					<li>Просмотров:&nbsp;<span class="badge"><?= $model->views ?></span></li>
				</ul>

			</div>
		</div>

	</div>
</div>


