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
			<div class="row">
				<div class="col-sm-offset-0 col-sm-12 col-xs-offset-3 col-xs-6 blank-img">
					<i class="fa fa-camera fa-2x" aria-hidden="true"></i></div>
			</div>

			<!--<a href="#">
          <?/*= Html::img( '/i/blank_img.jpg', [ 'class' => 'img-responsive', 'alt' => '', 'title' => '', ] ) */?>
			</a>-->

		</div>

		<div>
			<div class="caption">
				<a href="<?= Url::to( [
            '/adverts-views/details',
            'id' => $model->id
        ] ); ?>">
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

				<p class="price"><?= $model->price->price_value ?>&nbsp;<?= $model->price->currency->short_name ?>.</p>
			</div>

			<div class="pull-right">
				<ul class="list-inline">
					<li title="Редактирование объявления">
              <?= Html::a('<i class="fa fa-cog"></i>Редактировать', ['/adverts/update', 'id' => $model->id ], ['class' => 'btn btn-default',] ) ?>
					</li>
					<li title="Просмотр информации">
              <?= Html::a('<i class="fa fa-info-circle"></i>Инфо', ['', 'id' => $model->id ], ['class' => 'btn btn-default',] ) ?>
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


