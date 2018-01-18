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
use board\entities\Adverts;
use yii\web\NotFoundHttpException;
use frontend\models\UserPhones;
use frontend\models\adverts\AdvertsSearch;
use frontend\models\Images;

class AdvertsViewsController extends Controller
{
    public $layout = 'main';

    private $_service;
    public $pricies;

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

    /**
     * @return string
     */
    public function actionCategoryPage()
    {
        $searchModel = new AdvertsSearch();
        $dataProvider = $searchModel->searchCategoryPage( Yii::$app->request->queryParams );

        return $this->render( 'category-page', [
            'provider' => $dataProvider,
        ] );
    }

    /**
     * @return string
     */
    public function actionSubcategoryPage()
    {
        $searchModel = new AdvertsSearch();
        $dataProvider = $searchModel->searchSubcategoryPage( Yii::$app->request->queryParams );

        return $this->render( 'subcategory-page', [
            'provider' => $dataProvider,
        ] );
    }

    /**
     * @param $id
     * @return string
     */
    public function actionDetails( $id )
    {
        $sid = Yii::$app->session->id;
        $model = $this->findModel( $id );
        // Обновление счетчика просмотров
        $model->updateCounters(['views' => 1]);
        // TODO: sid
        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();
        $images = Images::find()->where( [ 'ad_id' => $id, 'sid' => $sid ] )->all();
        return $this->render( 'details', [
            'id'    => $id,
            'model' => $model,
            'phones' => $phones,
            'images' => $images,
        ] );
    }

    /**
     * @param $id
     * @return array|null|yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    protected function findModel( $id )
    {
        if ( ( $model = Adverts::find()
                ->where( [ 'adverts.id' => $id ] )
                ->joinWith( ['category', 'subcategory', 'types', 'periods', 'countries', 'pricies' ] )
                ->joinWith( [ 'pricies p' => function ( $q ){ $q->joinWith( 'currencies c' ); } ] )
                ->one()
            ) !== null
        ) {
            return $model;
        }
        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}