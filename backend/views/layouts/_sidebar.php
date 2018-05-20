<?php
/**
 * File: sidebar.php
 * Email: becksonq@gmail.com
 * Date: 29.10.2017
 * Time: 15:20
 */

?>

<div class="col-sm-3 col-md-2 sidebar">

	<ul class="nav nav-sidebar">
		<li class="active">
			<a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>">Старые пользователи</a>
		</li>
		<li>
			<a href="<?= \yii\helpers\Url::to( [ '/advert/index' ] ) ?>">Старые объявления</a>
		</li>
		<li>
			<a href="<?= \yii\helpers\Url::to( [ '/adverts/index' ] ) ?>">Новые объявления</a>
		</li>
		<li>
			<a href="<?= \yii\helpers\Url::to( [ '/categories/index' ] ) ?>">Категории</a>
		</li>
		<li><a href="<?= \yii\helpers\Url::to( [ '/subcategory/index' ] ) ?>">Подкатегории</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/countries/index' ] ) ?>">Города</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/types/index' ] ) ?>">Тип объявления</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/periods/index' ] ) ?>">Период</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/currencies/index' ] ) ?>">Валюта</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/responses/index' ] ) ?>">Отклики</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/user/admin' ] ) ?>">Rbac</a></li>
	</ul>

</div>
