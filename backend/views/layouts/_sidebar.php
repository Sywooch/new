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
			<a href="<?= \yii\helpers\Url::to( [ '/category/index' ] ) ?>">Категории</a>
		</li>
		<li><a href="<?= \yii\helpers\Url::to( [ '/subcategory/index' ] ) ?>">Подкатегории</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/country/index' ] ) ?>">Города</a></li>

		<li><a href="<?= \yii\helpers\Url::to( [ '/user/admin' ] ) ?>">Rbac</a></li>
	</ul>

</div>
