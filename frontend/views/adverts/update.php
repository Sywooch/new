<?php
/**
 * File: create.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:35
 */

use frontend\assets\FontAwesomeAsset;
use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

/* @var $model frontend\controllers\AdvertsController */
/* @var $category frontend\controllers\AdvertsController */
/* @var $type frontend\controllers\AdvertsController */
/* @var $period frontend\controllers\AdvertsController */
/* @var $country frontend\controllers\AdvertsController */
/* @var $price frontend\controllers\AdvertsController */
/* @var $currency frontend\controllers\AdvertsController */
/* @var $phones frontend\controllers\AdvertsController */

FontAwesomeAsset::register( $this );
ImagesAsset::register( $this );
PhonesAsset::register( $this );

$this->title = 'Редактировать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-update">

    <?= $this->render( '_form', [
        'model'       => $model,
        //        'price'        => $price,
        'currency'    => $currency,
        //        'currencyList' => $currencyList,
        'phonesArray' => $phonesArray,
        'images'      => $images,
    ] ) ?>
</div>
