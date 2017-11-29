<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

	<div class="body-content">

		<div class="row">

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

				<h2 class="page-header">Dashboard</h2>

				<ol>

					<li><a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>">Старые пользователи</a></li>

					<li>
						<a href="<?= \yii\helpers\Url::to( [ '/advert/index' ] ) ?>">Старые объявления</a>
					</li>
					<li>
						<a href="<?= \yii\helpers\Url::to( [ '/adverts/index' ] ) ?>">Новые объявления</a>
					</li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/category/index' ] ) ?>">Категории</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/subcategory/index' ] ) ?>">Подкатегории</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/countries/index' ] ) ?>">Города</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/types/index' ] ) ?>">Тип объявления</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/periods/index' ] ) ?>">Период</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/currencies/index' ] ) ?>">Валюта</a></li>

					<li><a href="<?= \yii\helpers\Url::to( [ '/user/admin' ] ) ?>">Rbac</a></li>
				</ol>

			</div>

		</div>

	</div>
</div>
