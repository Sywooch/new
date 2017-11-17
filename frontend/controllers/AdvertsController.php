<?php

namespace frontend\controllers;

use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use board\manage\AdvertManageService;
use board\entities\Adverts;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use backend\models\Type;
use backend\models\Period;
use backend\models\Country;
use backend\models\Category;
use board\forms\ImageForm;
use frontend\models\Price;
use frontend\models\UserPhones;
use common\models\Helpers;
use backend\models\Currency;

class AdvertsController extends \yii\web\Controller
{
    public $layout = 'blank';

    private $_service;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'login', 'error', 'create', 'subcat', 'preview' ],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [ 'logout', 'index', 'view' ],
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

    public function __construct( $id, $module, AdvertManageService $service, $config = [] )
    {
        parent::__construct( $id, $module, $config );
        $this->_service = $service;
    }

    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    public function actionCreate()
    {
        $model = new Adverts();
        $_category = $this->_categoryList();
        $type = $this->_typeList();
        $_period = $this->_periodList();
        $_city = $this->_cityList();
        $price = new Price();
        $_currency = $this->_currencyList();
        $currency = new Currency();
        $phone = new UserPhones();

        if ( $model->load( Yii::$app->request->post() )
            && $price->load( Yii::$app->request->post() )
            && $phone->load( Yii::$app->request->post() )
            && $currency->load( Yii::$app->request->post() )
        ) {

//            Helpers::p(Yii::$app->request->post());

            $model->sid = $this->getSid();
            $model->ip = $this->getIp();

            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $model->save();
                $price->ad_id = $model->id;
                $price->save();

                foreach ( $phone['phone'] as $key => $val ) {
                    if ( $val != '' ) {
                        $phone->ad_id = $model->id;
                        $phone->phone = $val;
                        $phone->sort = $key;
                        $phone->save();
                    }
                }

                $transaction->commit();
            } catch ( \Exception $e ){
                $transaction->rollBack();
                throw $e;
//                var_dump( $model->getErrors() );
//                die();
            } catch ( \Throwable $e ){
                $transaction->rollBack();
                throw $e;
//                var_dump( $model->getErrors() );
//                die();
            }

            return $this->redirect( [ 'preview', 'id' => $model->id ] );
        }
        else {
            return $this->render( 'create', [
                'model'    => $model,
                'category' => $_category,
                'type'     => $type,
                'period'   => $_period,
                'city'     => $_city,
                'price'    => $price,
                'currency' => $_currency,
                'phone'    => $phone,
            ] );
        }
    }

    private function save()
    {

    }

    /**
     * @return int|number
     */
    private function getIp()
    {
        return Helpers::IpToNum( Yii::$app->request->userIP );
    }

    /**
     * @return string
     */
    private function getSid()
    {
        return $sid = md5( time() . rand( 1, 0xFFFFFF ) );
    }

    /**
     * @return array
     */
    private function _currencyList()
    {
        return ArrayHelper::map( Currency::find()->orderBy( 'id' )->asArray()->all(), 'id', 'short_name' );
    }

    /**
     * @return array
     */
    private function _categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'category_name' );
    }

    /**
     * @return array
     */
    private function _typeList()
    {
        return ArrayHelper::map( Type::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    /**
     * @return array
     */
    private function _periodList()
    {
        return ArrayHelper::map( Period::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    /**
     * @return array
     */
    private function _cityList()
    {
        return ArrayHelper::map( Country::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
    }

    public function actionPreview( $id )
    {
        $model = $this->findModel( $id );

        return $this->render( 'preview', [
            'model' => $model,
        ] );
    }

    public function actionView( $id )
    {
        $advert = $this->findModel( $id );

        $imagesForm = new ImageForm();
        if ( $imagesForm->load( Yii::$app->request->post() ) && $imagesForm->validate() ) {
            try{
                $this->_service->addPhotos( $advert->id, $imagesForm );
                return $this->redirect( [ 'view', 'id' => $advert->id ] );
            } catch ( \DomainException $e ){
                Yii::$app->errorHandler->logException( $e );
                Yii::$app->session->setFlash( 'error', $e->getMessage() );
            }
        }

        return $this->render( 'view', [
            'advert'     => $advert,
            'imagesForm' => $imagesForm,
        ] );
    }

    protected function findModel( $id )
    {
        if ( ( $model = Adverts::findOne( $id ) ) !== null ) {
            return $model;
        }
        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }

}
