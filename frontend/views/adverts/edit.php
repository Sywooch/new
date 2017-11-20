<?php
/**
 * File: create.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:35
 */
use yii\helpers\Html;

/* @var $model frontend\controllers\AdvertsController */
/* @var $category frontend\controllers\AdvertsController */
/* @var $type frontend\controllers\AdvertsController */
/* @var $period frontend\controllers\AdvertsController */
/* @var $city frontend\controllers\AdvertsController */
/* @var $price frontend\controllers\AdvertsController */
/* @var $currency frontend\controllers\AdvertsController */
/* @var $phone frontend\controllers\AdvertsController */

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="type-edit">

    <?= $this->render( '_edit_form', [
        'model'    => $model,
        'category' => $category,
        'type'     => $type,
        'period'   => $period,
        'city'     => $city,
        'price'    => $price,
        'currency' => $currency,
        'phone'    => $phone,
    ] ) ?>

</div>
