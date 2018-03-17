<?php
/**
 * File: SettingsController.php
 * Email: becksonq@gmail.com
 * Date: 15.12.2017
 * Time: 16:53
 */

namespace frontend\controllers\user;

use common\models\Helpers;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use dektrium\user\Finder;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class SettingsController extends BaseSettingsController
{
    public function __construct( $id, \yii\base\Module $module, Finder $finder, array $config = [] )
    {
        parent::__construct( $id, $module, $finder, $config );
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return ArrayHelper::merge( [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => [ 'adverts', 'account', ],
                        'roles'   => [ '@' ],
                    ],
                ],
            ],
        ], parent::behaviors() );
    }

    /**
     * @param $email
     * @return ActiveDataProvider
     */
    public function getUserAdverts( $email )
    {
        $query = \board\entities\Adverts::find()
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'type' )
            ->joinWith( 'period' )
            ->joinWith( 'country' )
            ->joinWith( [
                'price p' => function ( $q ){
                    $q->joinWith( 'currencies c' );
                }
            ] )
            ->where( [ 'email' => $email ] );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [ 'id' => SORT_DESC ],
                'attributes'   => [
                    'id' => [
                        'asc'  => [ 'id' => SORT_ASC ],
                        'desc' => [ 'id' => SORT_DESC ],
                    ],
                ],
            ],
            'pagination' => [
                'defaultPageSize' => 25,
                'pageSizeLimit'   => [ 15, 100 ],
            ],
        ] );

        $dataProvider->sort->enableMultiSort = true;

        return $dataProvider;
    }

    /**
     * @return string
     */
    public function actionAdverts()
    {
        // TODO: изменить! Поиск не только по email
        $email = \Yii::$app->user->identity->email;

        $dataProvider = $this->getUserAdverts( $email );

        return $this->render( 'adverts', [
            'dataProvider' => $dataProvider,
        ] );
    }
}