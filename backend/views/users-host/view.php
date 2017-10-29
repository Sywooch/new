<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QAuthUser */

$this->title = $model->QAuthUserID;
$this->params['breadcrumbs'][] = ['label' => 'Qauth Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qauth-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->QAuthUserID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->QAuthUserID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'QAuthUserID',
            'QAuthUserEmail:email',
            'QAuthUserUserName',
            'QAuthUserPassHash',
            'QAuthUserActivationHash',
            'QAuthUserGroupID',
            'QAuthUserStatus',
            'QAuthUserCreated',
            'QAuthUserLastAuthDate',
            'QAuthUserLastIP',
            'QAuthUserFullName',
            'QAuthUserCompany',
            'QAuthUserWebsite',
            'QAuthUserPhone',
            'QAuthUserCity',
            'QAuthUserAddress',
            'QAuthUserZip',
            'QAuthUserICQ',
            'QAuthUserSkype',
            'QAuthUserTwitter',
            'QAuthUserLJ',
            'QAuthUserDOB',
            'QAuthUserGender',
            'QAuthUserRating',
            'QAuthUserAbout:ntext',
            'QAuthUserExtra:ntext',
            'rights',
        ],
    ]) ?>

</div>
