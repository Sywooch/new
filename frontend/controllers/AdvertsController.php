<?php

namespace frontend\controllers;

use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use board\forms\AdvertCreateForm;
use board\manage\AdvertManageService;
use board\entities\Adverts;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use backend\models\Subcategory;
use backend\models\Type;
use backend\models\Period;
use backend\models\Country;
use yii\helpers\Json;
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
                        'actions' => [ 'login', 'error', 'create', 'subcat' ],
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
//            print '<pre>';
//            print_r( Yii::$app->request->post() );
//            print '</pre>'; die;

            $model->sid = $this->getSid();
            $model->ip = $this->getIp();

            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $model->save();
                $price->ad_id = $model->id;
                $price->save();
                $phone->ad_id = $model->id;
                $phone->save();
                $transaction->commit();
            } catch ( \Exception $e ){
                $transaction->rollBack();
                throw $e;
            } catch ( \Throwable $e ){
                $transaction->rollBack();
                throw $e;
            }

//            if ( $model->save() ) {
                return $this->redirect( [ 'view', 'id' => $model->id ] );
//            }
//            else {
//                var_dump( $model->getErrors() );
//                die();
//            }
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


    private function getIp()
    {
        return Helpers::IpToNum( Yii::$app->request->userIP );
    }

    private function getSid()
    {
        return $sid = md5( time() . rand( 1, 0xFFFFFF ) );
    }

    public function actionSubcat()
    {
        $out = [];

        if ( Yii::$app->request->post( 'depdrop_parents' ) ) {

            $parents = Yii::$app->request->post( 'depdrop_parents' );

            if ( $parents != null ) {
                $cat_id = $parents[0];
                $out = self::subcategoryList( $cat_id );
                echo Json::encode( [ 'output' => $out, 'selected' => '' ] );
                return;
            }
        }

        echo Json::encode( [ 'output' => '', 'selected' => '' ] );
    }

    private function _currencyList()
    {
        return ArrayHelper::map( Currency::find()->orderBy( 'id' )->asArray()->all(), 'id', 'short_name' );
    }

    private function _categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'category_name' );
    }

    public function subcategoryList( $cat_id )
    {
        $array = ArrayHelper::map( Subcategory::find()->where( [ 'cat_id' => $cat_id ] )->orderBy( 'menu_order' )->asArray()->all(),
            'id', 'subcat_name' );

        $result = [];
        foreach ( $array as $key => $value ) {
            $result[] = [ 'id' => $key, 'name' => $value ];
        }
        return $result;
    }

    private function _typeList()
    {
        return ArrayHelper::map( Type::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    private function _periodList()
    {
        return ArrayHelper::map( Period::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    private function _cityList()
    {
        return ArrayHelper::map( Country::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
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
