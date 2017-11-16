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
/* @var $subcategory frontend\controllers\AdvertsController */
/* @var $type frontend\controllers\AdvertsController */
/* @var $period frontend\controllers\AdvertsController */
/* @var $city frontend\controllers\AdvertsController */
/* @var $price frontend\controllers\AdvertsController */
/* @var $phone frontend\controllers\AdvertsController */

$this->title = 'Создать объявление';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="type-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
				'category' => $category,
        'subcategory' => $subcategory,
        'type' => $type,
        'period' => $period,
        'city' => $city,
        'price' => $price,
        'phone' => $phone,
    ]) ?>

</div>
