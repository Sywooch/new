<?php
/**
 * User: beckson
 * Date: 16.11.2017
 * Time: 11:38
 * Email: becksonq@gmail.com
 */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row"><div class="col-sm-9">

			<div class="row" style="padding-bottom: 15px;">
				<div class="col-sm-7">
					<p id="adv-type">Тип: <strong><?= $model->type ?></strong>
						<span id="place-date" class="pull-right">Период:&nbsp;<?= $model->created_at ?></span></p><hr>

					<div>
						<h4><?= $model->header ?></h4>
						<hr>
						<!-- Текст объявления -->
						<p id="new-adv-text"><?= $model->description ?></p><hr>
						<div id="details">
							<# CUSTOM_FORM #>
								<p><i class="fa fa-map-marker fa-fw"></i>Город:<span class="pull-right"><?= $model->city ?></span></p>
								<hr>
								<p><i class="fa fa-money fa-fw"></i>Цена:<span class="pull-right">
										<span class="label label-danger"><strong>500 руб</strong></span></span>
								</p>
								<hr>
								<p><i class="fa fa-user fa-fw"></i>Автор:<span class="pull-right"><strong><?= $model->author ?></strong></span></p>
								<hr>
								<p><i class="fa fa-phone fa-fw"></i>Телефон:<span class="pull-right"><?/*= $model->phone */?></span></p>
								<hr>
								<!-- <p>{QPL_STR_T_SEARCH_ADV_FORM_PERIOD}:<span class="pull-right"><# TIME #></span></span> -->
								<!-- <p>{QPL_STR_T_ADV_ID}<span class="pull-right"><# ID #></span></span> -->
								<p><i class="fa fa-info fa-fw"></i>Статус:<span class="pull-right"><?= $model->active ?></span></p>
								<hr>
						</div>
					</div>
				</div>
				<!-- end of left block -->
				<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
				<!-- start right block -->
				<div class="col-sm-5">
					<div id="big-picture" class="center-block"><div id="big-img-loader"><# BIG_PICTURE #></div></div>
					<div id="rowSmallPics" class="row" style="margin-left: 0; margin-top: 15px;"><# SMALL_PICS #></div>

					<div id="email_sender<# ID #>">
						<# LINKS #>
					</div>

				</div>
				<div class="clearfix"></div><hr>
				<div class="col-sm-12">
					<a href="" class="btn btn-primary">Сохранить</a>
				</div>
			</div>
</div><div class="col-sm-3">Sidebar</div> </div>