<?php
/**
 * File: _single_advert.php
 * Email: becksonq@gmail.com
 * Date: 26.11.2017
 * Time: 22:04
 */
use yii\helpers\Html;
?>

<!--<div class="product-layout product-list col-xs-12">
    <div class="product-thumb">
        <div class="image"><a href="https://demo.opencart.com/index.php?route=product/product&amp;path=25_28&amp;product_id=42"><img src="https://demo.opencart.com/image/cache/catalog/demo/apple_cinema_30-228x228.jpg" alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;" class="img-responsive"></a></div>
        <div>
            <div class="caption">
                <h4><a href="https://demo.opencart.com/index.php?route=product/product&amp;path=25_28&amp;product_id=42">Apple Cinema 30"</a></h4>
                <p>The 30-inch Apple Cinema HD Display delivers an amazing 2560 x 1600 pixel resolution. Designed speci..</p>
                <p class="price"> <span class="price-new">$110.00</span> <span class="price-old">$122.00</span> <span class="price-tax">Ex Tax: $90.00</span> </p>
            </div>
            <div class="button-group">
                <button type="button" onclick="cart.add('42', '2');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md">Add to Cart</span></button>
                <button type="button" data-toggle="tooltip" title="" onclick="wishlist.add('42');" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></button>
                <button type="button" data-toggle="tooltip" title="" onclick="compare.add('42');" data-original-title="Compare this Product"><i class="fa fa-exchange"></i></button>
            </div>
        </div>
    </div>
</div>-->

<!-- ---------------------------------------------------------------------------------------------------------------- -->
<div class="col-xs-12">
    <div class="ad-thumb">
        <div class="image">
            <a href="https://demo.opencart.com/index.php?route=product/product&amp;path=25_28&amp;product_id=42">
							<img src="https://demo.opencart.com/image/cache/catalog/demo/apple_cinema_30-228x228.jpg" alt="Apple Cinema 30&quot;" title="Apple Cinema 30&quot;" class="img-responsive" width="160" height="160">
						</a>
        </div>

        <div>
            <div class="caption">
                <a href="<?= Yii::$app->urlManager->createUrl( [
                    'adverts/view-single',
                    'id' => $model['id']
                ] ); ?>">
                    <h5>ремонтно-строительные услуги.</h5>
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

                <p class="text-danger price-str">500 руб.</p>
            </div>
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
                       data-content="наша компания занимается всеми видами строительно-монтажных и отделочных работ в архангельске и области. мы предоставляем следующий спектр у..."
                       data-original-title="" title="" style="z-index: -222;">
                        <i class="fa fa-align-left"></i>
                    </a>
                </li>
                <li class="adv-type">
                    Тип:&nbsp;<strong><span>Продам</span></strong>
                </li>
                <li>Просмотров:&nbsp;<span class="badge">1</span></li>
            </ul>

        </div>


    <div class="col-sm-12">
        <hr>
    </div>

    </div>
</div>
