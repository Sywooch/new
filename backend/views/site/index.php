<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Admin</h2>

                <p>
									<a href="<?= \yii\helpers\Url::to( [ '/users-host/index' ] ) ?>">Старые пользователи</a>
							</p>
							<hr>
            </div>
        </div>

    </div>
</div>
