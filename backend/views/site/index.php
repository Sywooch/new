<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Admin</h2>
							<hr>
                <p>
									<a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>">Старые пользователи</a>
									<br>
									<a href="<?= \yii\helpers\Url::to( [ '/category/index' ] ) ?>">Категории</a>
									<br>
									<a href="<?= \yii\helpers\Url::to( [ '/subcategory/index' ] ) ?>">Подкатегории</a>
									<br>
									<a href="<?= \yii\helpers\Url::to( [ '/country/index' ] ) ?>">Города</a>
									<br>
									<a href="<?= \yii\helpers\Url::to( [ '/user/admin' ] ) ?>">Rbac</a>
							</p>

            </div>
        </div>

    </div>
</div>
