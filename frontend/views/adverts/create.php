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
/* @var $country frontend\controllers\AdvertsController */
/* @var $price frontend\controllers\AdvertsController */
/* @var $currency frontend\controllers\AdvertsController */
/* @var $phones frontend\controllers\AdvertsController */
/* @var $images frontend\controllers\AdvertsController */

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="adverts-create">

    <?= $this->render( '_form', [
        'model'    => $model,
        'price'    => $price,
        'phones'   => $phones,
				'images'   => $images,
    ] ) ?>

</div>
