<?php
/**
 * File: AdvertsViewsController.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:36
 */

namespace frontend\controllers;

use common\models\Helpers;
use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use board\manage\AdvertManageService;
use yii\data\ActiveDataProvider;
use board\entities\Adverts;
use yii\data\Sort;
use yii\web\NotFoundHttpException;
use frontend\models\UserPhones;

class AdvertsViewsController extends Controller
{
    public $layout = 'main';

    private $_service;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'subcategory-page', 'category-page', 'details' ],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [],
                        'allow'   => true,
                        'roles'   => [ '@' ],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

    /**
     * AdvertsViewsController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param AdvertManageService $service
     * @param array $config
     */
    public function __construct( $id, $module, AdvertManageService $service, $config = [] )
    {
        parent::__construct( $id, $module, $config );
        $this->_service = $service;
    }

    public static function homeAdvertsPage(){

        $query = Adverts::find()
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'types' )
            ->joinWith( 'periods' )
            ->joinWith( 'countries' )
            ->joinWith( [
                'pricies p' => function ( $q ){
                    $q->joinWith( 'currencies c' );
                }
            ] );

        $pageSize = self::_setPageSize();

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
            'pagination'   => [
                'defaultPageSize' => 25,
                'pageSize' => $pageSize,
                'pageSizeLimit' => [ 15, 100 ],
            ],
        ] );

        $dataProvider->sort->enableMultiSort = true;

        return $dataProvider;
    }

    /**
     * @return string
     */
    public function actionCategoryPage( $id )
    {
        $sort = new Sort( [
            'attributes' => [
                'header'       => [
                    'asc'  => [ 'header' => SORT_ASC, ],
                    'desc' => [ 'header' => SORT_DESC, ],

                    //                    'label' => 'Name',
                ],
                'defaultOrder' => [ 'id' => SORT_DESC ],
            ],
        ] );

        $query = Adverts::find()
            ->where( [ 'adverts.cat_id' => $id ] )
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'types' )
            ->joinWith( 'periods' )
            ->joinWith( 'countries' )
            ->joinWith( [
                'pricies p' => function ( $q ){
                    $q->joinWith( 'currencies c' );
                }
            ] );

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
                'pageSizeLimit' => [ 15, 100 ],
            ]
        ] );

        $dataProvider->sort->enableMultiSort = true;

        return $this->render( 'category-page', [
            'provider' => $dataProvider,
        ] );
    }

    public function actionSubcategoryPage( $catid, $id )
    {
        $query = Adverts::find()
            ->where( [ 'adverts.cat_id' => $catid ] )
            ->andWhere( [ 'adverts.subcat_id' => $id ] )
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'types' )
            ->joinWith( 'periods' )
            ->joinWith( 'countries' )
            ->joinWith( [
                'pricies p' => function ( $q ){
                    $q->joinWith( 'currencies c' );
                }
            ] );

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
                'pageSizeLimit' => [ 15, 100 ],
            ]
        ] );

        $dataProvider->sort->enableMultiSort = true;

        return $this->render( 'subcategory-page', [
            'provider' => $dataProvider,
        ] );
    }

    public function actionDetails( $id )
    {
        $model = $this->findModel( $id );
        // TODO:
        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();
        return $this->render( 'details', [
            'id'    => $id,
            'model' => $model,
            'phones' => $phones
        ] );
    }

    protected function findModel( $id )
    {
        if ( ( $model = Adverts::find()
                ->where( [ 'adverts.id' => $id ] )
                ->joinWith( 'category' )
                ->joinWith( 'subcategory' )
                ->joinWith( 'types' )
                ->joinWith( 'periods' )
                ->joinWith( 'countries' )
                ->joinWith( [ 'pricies p' => function ( $q ){ $q->joinWith( 'currencies c' ); } ] )
                ->one()
            ) !== null
        ) {
            return $model;
        }
        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }

    private function _setPageSize()
    {
        $pageSize = null;

        if ( Yii::$app->request->get( 'per-page' ) !== null ) {
            $cookies = Yii::$app->response->cookies;
            $cookies->remove( 'per-page' );
            $cookies->add( new \yii\web\Cookie( [
                'name'  => 'per-page',
                'value' => Yii::$app->request->get( 'per-page' ),
            ] ) );

            return $pageSize = Yii::$app->request->get( 'per-page' );
        }

        $cookies = Yii::$app->request->cookies;
        if ( ( $cookie = $cookies->get( 'per-page' ) ) !== null ) {
            $pageSize = $cookie->value;
        }

        return $pageSize;
    }
}