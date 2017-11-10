<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdvertSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Старые объявления';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Advert', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AdvertID',
            //'AdvertsID',
            //'AdvertFolder',
            //'AdvertType',
						[
							'attribute' => 'AdvertHeader',
							'contentOptions' =>['style'=>'white-space: pre-line;'],
							'value'=>'AdvertHeader',
						],
//             'AdvertComment:ntext',
            [
                'attribute'=>'Comment',
                'contentOptions' =>['style'=>'white-space: pre-line;'],
                'value'=>'AdvertComment',
            ],
            // 'AdvertCity',
             'AdvertPrice',
            // 'AdvertCurrency',
            // 'AdvertPeriod',
             'AdvertTime:datetime',
            // 'AdvertApproved',
            // 'AdvertActive',
            // 'AdvertPlaced',
            // 'AdvertSelected',
            // 'AdvertSelectedStart',
            // 'AdvertSelectedDur',
            // 'AdvertSpecial',
            // 'AdvertSpecialStart',
            // 'AdvertSpecialDur',
            // 'AdvertImage1',
            // 'AdvertImage2',
            // 'AdvertImage3',
            // 'AdvertImage4',
            // 'AdvertImage5',
            // 'AdvertImage6',
            // 'AdvertUserID',
            // 'AdvertUserName',
            // 'AdvertUserEmail:email',
            // 'AdvertUserPhone',
            // 'AdvertUserICQ',
            // 'AdvertUrl:url',
            // 'AdvertRate',
            // 'AdvertViewDay',
            // 'AdvertViewWeek',
            // 'AdvertViewMonth',
            // 'AdvertIPAdress',
            // 'AdvertIPProxyAdress',
            // 'AdvertSendViaEmail:email',
            // 'AdvertCustomValues:ntext',
            // 'AdvertPass',
            // 'AdvertImgDescription:ntext',
            // 'AdvertAdvHash:ntext',
            // 'AdvertTimeOriginated:datetime',
            // 'AdvertSold',
            // 'AdvertResponses',
            // 'AdvertUserPhone2',
            // 'AdvertAddress:ntext',
            // 'AdvertUp',
            // 'AdvertImg',
            // 'AdvertEmailReal:email',
            // 'exist_adv_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
