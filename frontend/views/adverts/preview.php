<?php
/**
 * User: beckson
 * Date: 16.11.2017
 * Time: 11:38
 * Email: becksonq@gmail.com
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\FontAwesomeAsset;

FontAwesomeAsset::register( $this );

$this->title = $model->header;
//$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\common\models\Helpers::p( $model->period ); die;
?>
<div class="row">
	<div class="col-sm-9">

		<div class="row" style="padding-bottom: 15px;">
			<div class="col-sm-7">
				<p>ID объявления:<span class="pull-right"><?= $model->id ?></span></p>
				<hr>
				<p id="adv-type">Тип:&nbsp;<?= $model->type->name ?>
					<span id="place-date" class="pull-right">Размещено:&nbsp;<?= Yii::$app->formatter->asDate( $model->created_at,
                  'php:d-F-Y H:m' ); ?>
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
										class="pull-right"><strong><?= $model->countries->country_name ?></strong></span></p>
							<hr>
							<p><i class="fa fa-money fa-fw"></i>Цена:<span class="pull-right">
										<span class="label label-danger"><strong><?= $price->price ?>
												&nbsp;<?= $price->currencies->short_name ?></strong></span></span>
								<?=  $price->negotiable == true ? '<p class="text-right"><i class="fa fa-check lime" aria-hidden="true"></i>Торг уместен</p>' : ""; ?>
							</p>
							<hr>

							<p><i class="fa fa-user fa-fw"></i>Автор:<span
										class="pull-right"><strong><?= $model->author ?></strong></span></p>
							<hr>
							<?php
							foreach ( $phones as $key => $val ){ ?>
								<p><i class="fa fa-phone fa-fw"></i>Телефон:<span class="pull-right"><?= $phones[$key]->phone ?></span></p>
								<hr>
							<?php }
							?>

							<p><i class="fa fa-calendar fa-fw"></i>Период:<span
										class="pull-right"><?= $model->periods->description ?></span></span></p>
							<hr>

							<p><i class="fa fa-info fa-fw"></i>Статус:<span class="pull-right"><?= $model->active == 1 ? "Активно" : "Не активно" ?></span></p>
							<hr>
					</div>
				</div>
			</div>
			<!-- end of left block -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<!-- start right block -->
			<div class="col-sm-5">
				<div id="big-picture" class="center-block">
					<div id="big-img-loader">
						<img id="Big<# ID #>" data-src="<# PATH #><# IMAGE #>?<# RND #>" class="img-thumbnail img-responsive"
								 alt="<# ALT #>" title="<# ALT #>"/>
					</div>
				</div>
				<div id="rowSmallPics" class="row" style="margin-left: 0; margin-top: 15px;">
					<# SMALL_PICS #>
				</div>

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