<?php
/**
 * User: beckson
 * Date: 16.11.2017
 * Time: 11:38
 * Email: becksonq@gmail.com
 */

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Helpers;
use frontend\assets\MagnificAsset;

MagnificAsset::register( $this );

/* @var $price frontend\controllers\AdvertsController */
/* @var $phones frontend\controllers\AdvertsController */
/* @var $images frontend\controllers\AdvertsController */

$this->title = $model->header; //d($model);die;
//$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="row">
		<div class="col-sm-9">

			<div class="row" style="padding-bottom: 15px;">
				<div class="col-sm-7">
					<p>ID объявления:<span class="pull-right"><?= $model->id ?></span></p>
					<hr>
					<p id="adv-type">Тип:&nbsp;<?= $model->type->name ?>
						<span id="place-date"
									class="pull-right">Размещено:&nbsp;<?= Yii::$app->formatter->asDatetime( $model->created_at,
									Yii::$app->params['dateFormat'] ); ?>
						</span>
					</p>
					<hr>

					<p><i class="fa fa-folder-open" aria-hidden="true"></i><?= $model->category->category_name ?>
						&nbsp;/&nbsp;<?= $model->subcategory->subcat_name ?>
					</p>
					<hr>

					<div>
						<h4><?= $model->header ?></h4>
						<hr>
						<!-- Текст объявления -->
						<p id="new-adv-text"><?= $model->description ?></p>
						<hr>
						<div id="details">
							<!--<# CUSTOM_FORM #>-->
							<p><i class="fa fa-map-marker fa-fw"></i>Расположение:<span
										class="pull-right"><strong><?= $model->country->country_name ?></strong></span></p>
							<hr>
							<p><i class="fa fa-money fa-fw"></i>Цена:<span class="pull-right">
										<span class="label label-danger"><strong><?= Helpers::format( $model->price->price_value ) ?>
												&nbsp;<?= $model->price->currency->short_name ?></strong></span></span>
								<?= $model->price->negotiable == true ? '<p class="text-right"><i class="fa fa-check lime" aria-hidden="true"></i>Торг уместен</p>' : ""; ?>
							</p>
							<hr>

							<p><i class="fa fa-user fa-fw"></i>Автор:<span
										class="pull-right"><strong><?= $model->author ?></strong></span></p>
							<hr>
							<?php foreach ( $model->phones as $key => $val ) { ?>
								<p><i class="fa fa-phone fa-fw"></i>Телефон:<span class="pull-right"><?= $val->phone ?></span>
								</p>
								<hr>
							<?php }
							?>

							<p><i class="fa fa-calendar fa-fw"></i>Период:<span
										class="pull-right"><?= $model->period->description ?></span></span></p>
							<hr>

							<p><i class="fa fa-info fa-fw"></i>Статус:<span
										class="pull-right"><?= $model->active == 1 ? "Активно" : "Не активно" ?></span></p>
							<hr>
						</div>
					</div>
				</div>
				<!-- end of left block -->
				<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
				<!-- start right block -->
				<div class="col-sm-5">
					<ul class="thumbnails list-unstyled">
						<?php
						if ( $images ) {
							foreach ( $images as $key => $value ) {
								if ( $key == 0 ) { ?>
									<li>
										<a class="thumbnail"
											 href="<?= Yii::getAlias( '@web' ) . '/img/temp/' . $images[$key]->sid . '/' . $images[$key]->filename ?>"
											 title="">
											<?= Html::img( '@web/img/temp/' . $images[$key]->sid . '/' . $images[$key]->filename ) ?>
										</a>
									</li>
								<?php } ?>

								<li class="image-additional">
									<a class="thumbnail"
										 href="<?= Yii::getAlias( '@web' ) . '/img/temp/' . $images[$key]->sid . '/' . $images[$key]->filename ?>"
										 title="">
										<?= Html::img( '@web/img/temp/' . $images[$key]->sid . '/' . $images[$key]->filename ) ?>
									</a>
								</li>

							<?php }
						}
						else { ?>
							<li class="thumbnail blank-img">
								<i class="fa fa-camera fa-2x" aria-hidden="true"></i>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="col-sm-12">
					<a href="<?= Url::to( [ '/adverts/update', 'id' => $model->id ] ) ?>" class="btn btn-default"><i
								class="fa fa-angle-double-left"
								aria-hidden="true"></i>Редактировать</a>
					<a href="<?= Url::to( [ '/adverts/save', 'id' => $model->id ] ) ?>" class="btn btn-primary">Сохранить<i
								class="fa fa-angle-double-right"
								aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		<div class="col-sm-3">Sidebar</div>
	</div>
<?php $this->registerJsFile( '@web/js/jquery.magnific-popup.min.js',
		[ 'depends' => [ \yii\web\JqueryAsset::className() ] ] ); ?>