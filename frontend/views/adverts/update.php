<?php
/**
 * File: _form.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 9:37
 */
use yii\helpers\Html;
use frontend\assets\FontAwesomeAsset;
use frontend\assets\ImagesAsset;
use frontend\assets\PhonesAsset;

FontAwesomeAsset::register( $this );
ImagesAsset::register( $this );
PhonesAsset::register( $this );

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

    <?= $this->render( '_form', [
        'model'       => $model,
        'phonesArray' => $phonesArray,
        'price'       => $price,
        'currency'    => $currency,
        'images'      => $images,
    ] ) ?>
</div>