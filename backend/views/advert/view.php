<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Advert */

$this->title = $model->AdvertID;
$this->params['breadcrumbs'][] = ['label' => 'Adverts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->AdvertID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->AdvertID], [
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
            'AdvertID',
            'AdvertsID',
            'AdvertFolder',
            'AdvertType',
            'AdvertHeader:ntext',
            'AdvertComment:ntext',
            'AdvertCity',
            'AdvertPrice',
            'AdvertCurrency',
            'AdvertPeriod',
            'AdvertTime:datetime',
            'AdvertApproved',
            'AdvertActive',
            'AdvertPlaced',
            'AdvertSelected',
            'AdvertSelectedStart',
            'AdvertSelectedDur',
            'AdvertSpecial',
            'AdvertSpecialStart',
            'AdvertSpecialDur',
            'AdvertImage1',
            'AdvertImage2',
            'AdvertImage3',
            'AdvertImage4',
            'AdvertImage5',
            'AdvertImage6',
            'AdvertUserID',
            'AdvertUserName',
            'AdvertUserEmail:email',
            'AdvertUserPhone',
            'AdvertUserICQ',
            'AdvertUrl:url',
            'AdvertRate',
            'AdvertViewDay',
            'AdvertViewWeek',
            'AdvertViewMonth',
            'AdvertIPAdress',
            'AdvertIPProxyAdress',
            'AdvertSendViaEmail:email',
            'AdvertCustomValues:ntext',
            'AdvertPass',
            'AdvertImgDescription:ntext',
            'AdvertAdvHash:ntext',
            'AdvertTimeOriginated:datetime',
            'AdvertSold',
            'AdvertResponses',
            'AdvertUserPhone2',
            'AdvertAddress:ntext',
            'AdvertUp',
            'AdvertImg',
            'AdvertEmailReal:email',
            'exist_adv_id',
        ],
    ]) ?>

</div>
