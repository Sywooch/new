<?php
/**
 * File: details.php
 * Email: becksonq@gmail.com
 * Date: 03.12.2017
 * Time: 7:52
 */

/* @var $id frontend\controllers\AdvertsViewsController */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->header;
//$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
//\common\models\Helpers::p( $model ); die;
?>
<div class="row">
		<div class="col-sm-7">
			<p>ID объявления:<span class="pull-right"><?= $model->id ?></span></p>
			<hr>
			<p id="adv-type">Тип:&nbsp;<strong><?= $model->types->name ?></strong>
				<span id="place-date"
							class="pull-right"><?= Yii::$app->formatter->asDatetime( $model->created_at,
                Yii::$app->params['dateFormat'] ); ?>
						</span>
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
										<span class="label label-danger"><strong><?= $model->pricies->price ?>
												&nbsp;<?= $model->pricies->currencies->short_name ?>.</strong></span></span>
              <?= $model->pricies->negotiable == true ? '<p class="text-right"><i class="fa fa-check lime" aria-hidden="true"></i>Торг уместен</p>' : ""; ?>
					</p>
					<hr>

					<p><i class="fa fa-user fa-fw"></i>Автор:<span
								class="pull-right"><strong><?= $model->author ?></strong></span></p>
					<hr>
            <?php
            foreach ( $phones as $key => $val ) { ?>
							<p><i class="fa fa-phone fa-fw"></i>Телефон:<span class="pull-right"><?= $phones[$key]->phone ?></span>
							</p>
							<hr>
            <?php }
            ?>

					<p><i class="fa fa-info fa-fw"></i>Статус:<span
								class="pull-right"><?= $model->active == 1 ? "Активно" : "Не активно" ?></span></p>
					<hr>

					<p><i class="fa fa-eye fa-fw"></i>Просмотров:<span class="pull-right">1</span></p>
					<hr>

					<p><i class="fa fa-reply-all fa-fw"></i>Откликов:<span class="pull-right">1</span></p>
					<hr>
				</div>
			</div>
		</div>
		<!-- end of left block -->
		<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
		<!-- start right block -->
		<div class="col-sm-5">

			<div class="row">
				<div class="col-sm-12 ">
					<div id="lr-btns" class="btn-group pull-right">
						<a class="btn btn-primary" href="<# SELF_URL #><# SCRIPT_NAME #>?qact=view_adv&id=<# PREVKEY #>"
							 title="Предыдущее объявление"><i class="fa fa-chevron-left"></i></a>
						<a class="btn btn-primary" href="<# SELF_URL #><# SCRIPT_NAME #>?qact=view_adv&id=<# NEXTKEY #>"
							 title="Следующее объявление"><i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			</div>

			<div id="big-picture" class="center-block thumbnail" style="width:100%; height: 120px; margin-top:10px;">

				<!--						<img src="/frontend/web/files/i/1x1.png" class="img-responsive" alt="Responsive image">-->
				<i class="fa fa-picture-o fa-4x" aria-hidden="true"></i>

			</div>
			<div id="rowSmallPics" class="row" style="margin-left: 0; margin-top: 15px;">
				<# SMALL_PICS #>
			</div>

			<div class="row">
			<div class="col-xs-12">
				<!-- Соцсети -->
				<noindex>
					<div id="new-social-viewadv">
						<a href="#" class="social_share" data-type="vk"><img src="/frontend/web/files/i/social/vk.png" title="Вконтакте"></a>
						<a id="fb" href="#" class="social_share" data-type="fb"><img src="/frontend/web/files/i/social/fb.png"
																																				 title="Фейсбук"></a>
						<a href="#" class="social_share" data-type="tw"><img src="/frontend/web/files/i/social/tw.png" title="Твиттер"></a>
						<a href="#" class="social_share" data-type="ok"><img src="/frontend/web/files/i/social/ok.png"
																																 title="Одноклассники"></a>
						<a href="#" class="social_share" data-type="mr"><img src="/frontend/web/files/i/social/mail.png"
																																 title="Mail.Ru"></a>
						<a href="#" class="social_share" data-type="gg"><img src="/frontend/web/files/i/social/g+.png" title="Google+"></a>
					</div>
					<script type="text/javascript">
			  var text = $('#new-adv-text').text();
			  var bigImage = $('#big-picture').find('img').attr('data-src');
			  $('#new-social-viewadv').find('a').attr('data-image', 'http://www.dob29.ru' + bigImage).find('a').attr('data-text', text);
					</script>
				</noindex>
			</div>
		</div>
		</div>

		<div class="clearfix"></div>
		<hr>
</div>