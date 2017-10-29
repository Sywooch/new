<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

	<div class="body-content">
		<div class="row">
			<div class="col-xs-12 col-sm-12 page-header">
				<h2>Admin</h2>
			</div>
		</div>

		<div class="row">

			<div class="col-xs-12 col-sm-9">
				<h4>Content</h4>
			</div>

			<div class="col-xs-6 col-sm-3">

				<div class="list-group">
					<a href="javascript:void(0)" class="list-group-item"><strong>Разделы</strong></a>
					<a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>" class="list-group-item active">Старые пользователи</a>

					<a href="<?= \yii\helpers\Url::to( [ '/category/index' ] ) ?>" class="list-group-item">Категории</a>

					<a href="<?= \yii\helpers\Url::to( [ '/subcategory/index' ] ) ?>" class="list-group-item">Подкатегории</a>

					<a href="<?= \yii\helpers\Url::to( [ '/country/index' ] ) ?>" class="list-group-item">Города</a>

					<a href="<?= \yii\helpers\Url::to( [ '/user/admin' ] ) ?>" class="list-group-item">Rbac</a>
				</div>

			</div>
		</div>

	</div>
</div>
