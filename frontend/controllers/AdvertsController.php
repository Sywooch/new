<?php

namespace frontend\controllers;

use backend\models\Category;
use board\forms\ImageForm;
use frontend\models\Price;
use frontend\models\UserPhones;
use yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use board\forms\AdvertCreateForm;
use board\manage\AdvertManageService;
use board\entities\Adverts;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use backend\models\Subcategory;
use backend\models\Type;
use backend\models\Period;
use backend\models\Country;
use yii\helpers\Json;
use yii\web\Response;

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
                        'actions' => [ 'login', 'error', 'create', 'subcat'],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [ 'logout', 'index' ],
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
        $category = $this->categoryList();
//        $subcategory = $this->subcategoryList( $cat_id );
        $type = $this->typeList();
        $period = $this->periodList();
        $city = $this->cityList();
        $price = new Price();
        $phone = new UserPhones();

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }
        else {
            return $this->render( 'create', [
                'model'    => $model,
                'category' => $category,
                //                'subcategory' => $subcategory,
                'type'     => $type,
                'period'   => $period,
                'city'     => $city,
                'price'    => $price,
                'phone'    => $phone,
            ] );
        }
    }

    public function actionSubcat()
    {
        $out = [];

        if ( Yii::$app->request->post( 'depdrop_parents' ) ) {

            $parents = Yii::$app->request->post( 'depdrop_parents' );

            if ( $parents != null ) {
                $cat_id = $parents[0];
                $out = self::subcategoryList( $cat_id ); //var_dump( $out ); exit;
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode( [ 'output' => $out, 'selected' => '' ] );
                return;
            }
        }

        echo Json::encode( [ 'output' => '1', 'selected' => '1' ] );
    }

    private function getPhone()
    {
        // TODO:
        return ArrayHelper::map( UserPhones::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'category_name' );
    }

    private function categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'category_name' );
    }

    private function subcategoryList( $cat_id )
    {
        return ArrayHelper::map( Subcategory::find()->where( [ 'cat_id' => $cat_id ] )->orderBy( 'menu_order' )->asArray()->all(),
            'id', 'subcat_name' );
    }

    private function typeList()
    {
        return ArrayHelper::map( Type::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    private function periodList()
    {
        return ArrayHelper::map( Period::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    private function cityList()
    {
        return ArrayHelper::map( Country::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
    }

    public function actionCreate_old()
    {
        $form = new AdvertCreateForm();

        if ( $form->load( Yii::$app->request->post() ) && $form->validate() ) {
            try{
                $advert = $this->_service->create( $form );
                return $this->redirect( [ 'view', 'id' => $advert->id ] );
            } catch ( \DomainException $e ){
                Yii::$app->errorHandler->logException( $e );
                Yii::$app->session->setFlash( 'error', $e->getMessage() );
            }
        }

        /*$model = new Advert();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/

        return $this->render( 'create', [
            'model' => $form,
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
