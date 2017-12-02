<?php
/**
 * File: AdvertsViewsController.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:36
 */

namespace frontend\controllers;

use yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use board\manage\AdvertManageService;
use yii\data\ActiveDataProvider;
use board\entities\Adverts;

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
                        'actions' => [ 'subcategory-page' ],
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

    /**
     * @return string
     */
    public function actionSubcategoryPage( $id )
    {
        $query = Adverts::find()
            ->where( [ 'adverts.cat_id' =>$id ] )
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
            'pagination' => [
//                'pagesize' => 25,
            ]
        ] );

        return $this->render( 'subcategory-page', [
            'query'        => $query,
            'dataProvider' => $dataProvider,
            'header'       => Yii::$app->request->get( 'header' ),
            'sort'         => [
                'defaultOrder' => [ 'id' => SORT_DESC ],
                'attributes'   => [
                    'id' => [
                        'asc'  => [ 'id' => SORT_ASC ],
                        'desc' => [ 'id' => SORT_DESC ],
                    ],
                ],
            ],
            'pagination'   => [
                'pageSizeLimit' => [ 15, 100 ],
            ]
        ] );
    }
}