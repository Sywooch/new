<?php
/**
 * File: create.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:35
 */
use yii\helpers\Html;
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
/* @var $model /view/create.php */
/* @var $categoryList /view/create.php */
/* @var $categorySelected /view/create.php */
/* @var $type /view/create.php */
/* @var $period /view/create.php */
/* @var $price /view/create.php */
/* @var $currency /view/create.php */
/* @var $phones /view/create.php */
/* @var $country /view/create.php */
/* @var $phonesArray */
/* @var $images */

$this->title = 'Редактировать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adverts-update">
	<h1><?= Html::encode($this->title) ?></h1>

<div class="type-update">

    <?= $this->render( '_form', [
        'model'    => $model,
        'category' => $category,
        'type'     => $type,
        'period'   => $period,
        'country'  => $country,
        'price'    => $price,
        'currency' => $currency,
        'phones'   => $phones,
    ] ) ?>

    <?= $this->render( '_form', [
        'model'       => $model,
        'phonesArray' => $phonesArray,
        'price'       => $price,
        'currency'    => $currency,
        'images'      => $images,
    ] ) ?>
</div>
