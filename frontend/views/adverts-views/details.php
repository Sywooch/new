<?php
/* @var $images frontend\controllers\AdvertsController */
/* @var $responses \frontend\models\Responses */

use yii\helpers\Html;
use yii\captcha\Captcha;
use frontend\assets\MagnificAsset;
use board\entities\Adverts;
use backend\models\Pricies;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\web\View;

MagnificAsset::register( $this );

$this->title = $model->header;
$this->params['breadcrumbs'][] = [
    'label' => $model->category->category_name,
    'url'   => [
        'adverts-views/category-page',
        'id'  => $model->cat_id,
        'cat' => $model->category->category_name
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->subcategory->subcat_name,
    'url'   => [
        'adverts-views/subcategory-page',
        'catid'  => $model->cat_id,
        'id'     => $model->subcat_id,
        'cat'    => $model->category->category_name,
        'subcat' => $model->subcategory->subcat_name
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-sm-7">
		<p>ID объявления:<span class="pull-right"><?= $model->id ?></span></p>
		<hr>
		<p id="adv-type">Тип:&nbsp;<strong><?= $model->type->name ?></strong>
			<span id="place-date" class="pull-right"><?= Yii::$app->formatter->asDatetime( $model->created_at ); ?></span>
		</p>
		<hr>

		<div>
			<h4><?= $model->header ?></h4>
			<hr>
			<p id="new-adv-text"><?= $model->description ?></p>
			<hr>
			<div id="details">
				<p><i class="fa fa-map-marker fa-fw"></i>Расположение:<span
							class="pull-right"><strong><?= $model->country->country_name ?></strong></span></p>
				<hr>
				<p><i class="fa fa-money fa-fw"></i>Цена:<span class="pull-right">
										<span
												class="label label-danger"><strong><?= !empty( $model->price->price_value )
                                ? Yii::$app->formatter->asInteger( $model->price->price_value ) . Pricies::PRICE_CURRENCY_SEPARATOR . $model->price->currency->short_name
                                : Pricies::EMPTY_PRICE_VALUE ?></strong></span></span>

            <?= $model->price->negotiable == true ? '<p class="text-right"><i class="fa fa-check lime" aria-hidden="true"></i>Торг уместен</p>' : ""; ?>
				</p>
				<hr>

				<p><i class="fa fa-user fa-fw"></i>Автор:<span
							class="pull-right"><strong><?= $model->author ?></strong></span></p>
				<hr>
          <?php
          foreach ( $model->phones as $key => $val ) { ?>
						<p><i class="fa fa-phone fa-fw"></i>Телефон:<span class="pull-right"><?= $val->phone ?></span>
						</p>
						<hr>
          <?php }
          ?>

				<p><i class="fa fa-info fa-fw"></i>Статус:<span
							class="pull-right"><?= $model->active == 1 ? "Активно" : "Не активно" ?></span></p>
				<hr>

				<p><i class="fa fa-eye fa-fw"></i>Просмотров:<span class="pull-right"><?= $model->views ?></span></p>
				<hr>

				<p><i class="fa fa-reply-all fa-fw"></i>Откликов:<span class="pull-right"><?= $model->response_count ?></span>
				</p>
				<hr>
			</div>
		</div>

		<div id="resp_mail" class="row">
			<div class="col-xs-12">
				<a class="btn btn-success pull-right" role="button" data-toggle="collapse" href="#response-ad"
					 aria-expanded="false" aria-controls="response-ad" title="Отправить письмо продавцу">Ответить на
					объявление&nbsp;&nbsp;<span
							class="caret"></span></a>
			</div>
        <?= $this->render( '_response-form', [
            'responses' => $responses,
            'model'     => $model,
            'status'    => $status,
            'messages'  => $messages,
        ] )
        ?>
		</div>
	</div>
	<!-- end of left block -->
	<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
	<!-- start right block -->
	<div class="col-sm-5">

		<div class="row">
			<div class="col-sm-12 col-xs-12 mb10">
				<div id="lr-btns" class="btn-group pull-right">
            <?= Html::a( '<i class="fa fa-chevron-left"></i>',
                [ 'adverts-views/details', 'id' => Adverts::getPrevNextPage( $model->id, Adverts::PREV_PAGE_DIRECT ) ],
                [ 'class' => 'btn btn-primary', 'title' => 'Предыдущее объявление' ] ) ?>
            <?= Html::a( '<i class="fa fa-chevron-right"></i>',
                [ '/adverts-views/details', 'id' => Adverts::getPrevNextPage( $model->id, Adverts::NEXT_PAGE_DIRECT ) ],
                [ 'class' => 'btn btn-primary', 'title' => 'Следующее объявление' ] ) ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<ul class="thumbnails list-unstyled">
            <?php
            if ( $model->has_images ) {
                foreach ( $model->images as $key => $value ) {
                    if ( $key == 0 ) { ?>
											<li>
												<a class="thumbnail"
													 href="<?= Yii::getAlias( '@web' ) . '/img/temp/' . $value->sid . '/' . $value->filename ?>"
													 title="">
                            <?= Html::img( '@web/img/temp/' . $value->sid . '/' . $value->filename ) ?>
												</a>
											</li>
                    <?php } ?>

									<li class="image-additional">
										<a class="thumbnail"
											 href="<?= Yii::getAlias( '@web' ) . '/img/temp/' . $value->sid . '/' . $value->filename ?>"
											 title="">
                        <?= Html::img( '@web/img/temp/' . $value->sid . '/' . $value->filename ) ?>
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
		</div>

		<div class="row">
			<div class="col-sm-12 col-xs-12 text-right">
				<hr>
			</div>
			<div class="col-sm-12 col-xs-12 text-right">
				<!-- Соцсети -->
				<noindex>
					<div id="new-social-viewadv">
						<a href="#" class="social_share" data-type="vk"><?= Html::img( '@web/i/social/vk.png',
                    [ 'title' => 'Вконтакте', 'alt' => 'Вконтакте' ] ) ?></a>
						<a href="#" class="social_share" data-type="ok"><?= Html::img( '@web/i/social/ok.png',
                    [ 'title' => 'Одноклассники', 'alt' => 'Одноклассники' ] ) ?></a>
						<a href="#" class="social_share" data-type="mr"><?= Html::img( '@web/i/social/mail.png',
                    [ 'title' => 'Mail.ru', 'alt' => 'Mail.ru' ] ) ?></a>
						<a id="fb" href="#" class="social_share" data-type="fb"><?= Html::img( '@web/i/social/fb.png',
                    [ 'title' => 'Facebook', 'alt' => 'Фейсбук' ] ) ?></a>
						<a href="#" class="social_share" data-type="tw"><?= Html::img( '@web/i/social/tw.png',
                    [ 'title' => 'Twitter', 'alt' => 'Twitter' ] ) ?></a>
						<a href="#" class="social_share" data-type="gg"><?= Html::img( '@web/i/social/g+.png',
                    [ 'title' => 'Google+', 'alt' => 'Google+' ] ) ?></a>
					</div>
				</noindex>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="col-xs-12">
		<hr>
	</div>
</div>