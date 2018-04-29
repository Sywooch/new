<?php
/**
 * File: _single_advert.php
 * Email: becksonq@gmail.com
 * Date: 26.11.2017
 * Time: 22:04
 */
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Pricies;

/* @var $model frontend\controllers\AdvertsViewsController */
//\common\models\Helpers::p( $model ); die;
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

					}
					else { ?>

						<div class="blank-img">
							<i class="fa fa-camera fa-2x" aria-hidden="true"></i>
						</div>

					<?php } ?>
				</div>
			</div>
		</div>

		<div>
			<div class="caption">
				<h5>
					ID:&nbsp;<?= $model->id ?>
				</h5>
				<a href="<?= Url::to( [ '/adverts-views/details', 'id' => $model->id ] ); ?>">
					<h5><?= $model->header ?></h5>
				</a>
				<p>
					<small><i class="fa fa-calendar" aria-hidden="true"></i>
							<?= Yii::$app->formatter->asDatetime( $model->created_at, Yii::$app->params['dateFormat'] ); ?>
						<br>
						<i class="fa fa-map-marker" aria-hidden="true"></i><?= $model->country->country_name ?>,
						<i class="fa fa-folder-open" aria-hidden="true"></i><?= $model->category->category_name ?>
							&nbsp;/&nbsp;<?= $model->subcategory->subcat_name ?>
					</small>
				</p>
				<hr>
				<p>
					<?= $model->description ?>
				</p>

				<p class="price"><?= !empty( $model->price->price_value )
							? Yii::$app->formatter->asInteger( $model->price->price_value ) . Pricies::PRICE_CURRENCY_SEPARATOR . $model->price->currency->short_name
							: Pricies::EMPTY_PRICE_VALUE ?>
				</p>
			</div>

			<div class="pull-right">
				<ul class="list-inline">
					<li title="Просмотр информации">
              <?= Html::a('<i class="fa fa-info-circle"></i>Инфо', ['', 'id' => $model->id ], ['class' => 'btn btn-default',] ) ?>
					</li>
					<li title="Редактирование объявления">
						<?= Html::a( '<i class="fa fa-cog"></i>Редактировать', [ '/adverts/update', 'id' => $model->id ],
								[ 'class' => 'btn btn-default', ] ) ?>
					</li>
					<li title="Удаление объявления">
						<?= Html::a( '<i class="fa fa-trash"></i>Удалить', [ '/adverts/delete', 'id' => $model->id ], [
								'class'        => 'btn btn-danger',
								'data-confirm' => 'Вы хотите удалить это объявление?',
								'data-method'  => 'post',
						] ) ?>
					</li>
				</ul>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="info">
			<ul class="list-unstyled">
				<li>

				</li>
			</ul>
		</div>
	</div>
</div>


