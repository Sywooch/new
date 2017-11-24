<?php

namespace frontend\controllers;

use backend\controllers\UsersHostController;
use backend\models\Subcategory;
use board\repositories\AdvertsRepository;
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
use yii\base\Model;

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
                        'actions' => [ 'login', 'error', 'create', 'subcat', 'preview', 'save', 'success', 'edit' ],
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
        $categoryList = AdvertsRepository::categoryList();
        $typeList = AdvertsRepository::typeList();
        $periodList = AdvertsRepository::periodList();
        $countryList = AdvertsRepository::countryList();
        $price = new Price();
        $currencyList = AdvertsRepository::currencyList();
        $currency = new Currency();
        $phones = new UserPhones();


//        $advertForm = new AdvertsRepository();
//        $advertForm->createAdvertForm();

//        if (!isset($user, $profile)) {
//            throw new NotFoundHttpException("The user was not found.");
//        }

        if ( $model->load( Yii::$app->request->post() )
            && $price->load( Yii::$app->request->post() )
            && $phones->load( Yii::$app->request->post() )
            && $currency->load( Yii::$app->request->post() )
        ) {
            $model->sid = AdvertsRepository::getSid();
            $model->ip = AdvertsRepository::getIp();
//            $model->draft = 1;
//                Helpers::p( yii::$app->request->post() ); die;
            $transaction = \Yii::$app->db->beginTransaction();
            try{
//                $model->save();
                if ( !$model->save() ) {
                    throw new \RuntimeException( 'Saving $model error.' );
                }
//                Helpers::p( $model->id, 1 ); die;
                $price->ad_id = $model->id;
                $price->currency_id = $currency->short_name;
//                $price->save();
                if ( !$price->save() ) {
                    throw new \RuntimeException( 'Saving $price error.' );
                }

                foreach ( $phones->phone as $key => $val ) {
                    if ( $val != '' ) {
                        $userphones = new UserPhones();
                        $userphones->ad_id = $model->id;
                        $userphones->user_id = Yii::$app->user->id;
                        $userphones->phone = $val;
                        $userphones->sort = $key;
                        $userphones->isNewRecord = true;
//                        $userphones->save();
                        if ( !$userphones->save() ) {
                            throw new \RuntimeException( 'Saving $userphones error.' );
                        }
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
//                \Yii::$app->session->setFlash('error','DB Error');
                throw $e;
//                var_dump( $model->getErrors() );
//                die();
            }

            return $this->redirect( [ 'preview', 'id' => $model->id ] );
        }
        else {
            return $this->render( 'create', [
                'model'    => $model,
                'category' => $categoryList,
                'type'     => $typeList,
                'period'   => $periodList,
                'country'  => $countryList,
                'price'    => $price,
                'currency' => $currencyList,
                'phones'   => $phones,
            ] );
        }
    }

    public function actionPreview( $id )
    {
        $model = Adverts::find()
            ->select( 'adverts.*' )
            ->where( [ 'adverts.id' => $id ] )
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'type' )
            ->joinWith( 'period' )
            ->joinWith( 'country' )
            ->one();
        $price = Price::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currency' )->one();
        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();

        return $this->render( 'preview', [
            'model'  => $model,
            'price'  => $price,
            'phones' => $phones,
        ] );
    }

    public function actionEdit( $id )
    {
//        $model = $this->findModel( $id );

        $model = Adverts::find()
            ->select( 'adverts.*' )
            ->where( [ 'adverts.id' => $id ] )
            ->joinWith( 'category' )
            ->joinWith( 'subcategory' )
            ->joinWith( 'type' )
            ->joinWith( 'period' )
            ->joinWith( 'country' )
            ->one();
        $price = Price::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currency' )->one();
        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();

//        $category = Category::find()->where( [ 'id' => $model->cat_id ] )->one();
//        $subcategory = Subcategory::find()->where( [ 'id' => $model->subcat_id ] )->one();
//        $type = Type::find()->where( [ 'id' => $model->type ] )->one();
//        $country = Country::find()->where( [ 'id' => $model->country ] )->one();
        $price = Price::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currency' )->one();
        $phone = UserPhones::find()->where( [ 'ad_id' => $id ] )->one(); //var_dump( $phone );
//        $period = Period::find()->where( [ 'id' => $model->periods ] )->one();

        return $this->render( 'edit', [
            'model'       => $model,
            'price'       => $price,
            'phone'       => $phone,
        ] );
    }

    public function actionSave( $id )
    {
        $model = $this->findModel( $id );

        if( $model->draft == 0){
            return $this->redirect( [ 'success', ] );
        }
        if ( !$model->save() ) {
//            throw new \RuntimeException( 'Saving error.' );
            return $this->redirect( [ 'preview', 'id' => $model->id ] );
        }
        // TODO:
        return $this->render( [ 'success', ] );
    }

    public function actionSuccess()
    {
        return $this->render( 'success' );
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
