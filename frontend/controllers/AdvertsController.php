<?phpnamespace frontend\controllers;use board\repositories\AdvertsRepository;use Codeception\Lib\Generator\Helper;use common\models\Helpers;use frontend\models\Images;use yii;use yii\filters\VerbFilter;use yii\filters\AccessControl;use board\manage\AdvertManageService;use board\entities\Adverts;use yii\web\NotFoundHttpException;use board\forms\ImageForm;use backend\models\Pricies;use frontend\models\UserPhones;use backend\models\Currencies;class AdvertsController extends \yii\web\Controller{    public $layout = 'blank';    private $_service;    public function behaviors()    {        return [            'access' => [                'class' => AccessControl::className(),                'rules' => [                    [ 'actions' => [                            'login',                            'error',                            'create',                            'subcat',                            'preview',                            'save',                            'success',                            'update',                            'subcategory-page'                        ],                        'allow'   => true,                    ],                    [                        'actions' => [ 'logout', 'index', 'view' ],                        'allow'   => true,                        'roles'   => [ '@' ],                    ],                ],            ],            'verbs'  => [                'class'   => VerbFilter::className(),                'actions' => [                    'delete' => [ 'POST' ],                ],            ],        ];    }    public function actions()    {        return [//            'captcha' => [//                'class' => 'common\components\MathCaptchaAction',//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,//            ],        ];    }    /**     * AdvertsController constructor.     * @param string $id     * @param yii\base\Module $module     * @param AdvertManageService $service     * @param array $config     */    public function __construct( $id, $module, AdvertManageService $service, $config = [] )    {        parent::__construct( $id, $module, $config );        $this->_service = $service;    }    /**     * @return string     */    public function actionIndex()    {        return $this->render( 'index' );    }    public function actionCreate()    {        $model = new Adverts();        $price = new Pricies();        $currency = new Currencies();        $phones = new UserPhones();        $images = new Images();//        d($price);die;        if ( !isset( $model, $price, $currency, $phones, $images ) ) {            throw new NotFoundHttpException( "Models was not found." );        }        $data = Yii::$app->request->post();        $validModel = $model->load( $data ) && $model->validate();        $validPhones = $phones->load( $data ) && $phones->validate();        $validPrice = $price->load( $data ) && $price->validate();        $validCurrency = $currency->load( $data ) && $currency->validate();        if ( $validModel && $validPhones && $validPrice && $validCurrency ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                $model->sid = Yii::$app->session->id;                $model->ip = Helpers::IpToNum( Yii::$app->request->userIP );                if ( !$model->save() ) {//                    print_r($model->getErrors());                    throw new \RuntimeException( 'Saving $model error.' );                }                $price->ad_id = $model->id;                $price->currency_id = $currency->short_name;                $price->price = str_replace( ' ', '', $price->price );                $price->price = printf( '%d', $price->price );                if ( !$price->save() ) {                    throw new \RuntimeException( 'Saving $price error.' );                }                $this->saveUserPhones( $phones, $model->id );                // Сохраняем фото                Images::updateAll( [ 'ad_id' => $model->id ], [ 'sid' => $model->sid, 'marker' => $model->marker ] );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;            } catch ( \Throwable $e ){                $transaction->rollBack();                throw $e;            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        return $this->render( 'create', [            'model'    => $model,            'price'    => $price,            'phones'   => $phones,            'images'   => $images,        ] );    }    public function actionPreview( $id )    {        // TODO: изменить sid        $sid = Yii::$app->session->id;        $model = Adverts::find()            ->select( 'adverts.*' )            ->where( [ 'adverts.id' => $id ] )            ->joinWith( 'category' )            ->joinWith( 'subcategory' )            ->joinWith( 'type' )            ->joinWith( 'period' )            ->joinWith( 'country' )            ->one();        $price = Pricies::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currencies' )->one();        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();        $images = Images::find()->where( [ 'ad_id' => $id, 'sid' => $sid ] )->all();        return $this->render( 'preview', [            'model'  => $model,            'price'  => $price,            'phones' => $phones,            'images' => $images,        ] );    }    public function actionUpdate( $id )    {        $currency = new Currencies();        $phones = new UserPhones();        $images = new Images();        $model = $this->findUpdateModel( $id );        $currencyList = AdvertsRepository::currencyList();        $price = Pricies::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currencies' )->one();        $phonesArray = UserPhones::find()->where( [ 'ad_id' => $id ] )->all();        $data = Yii::$app->request->post();        $validModel = $model->load( $data );        $validPhones = $phones->load( $data );        $validPrice = $price->load( $data );        $validCurrency = $currency->load( $data );        if ( $validModel && $validPhones && $validPrice && $validCurrency ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                $model->sid = Yii::$app->session->id;                $model->ip = Helpers::IpToNum( Yii::$app->request->userIP );                if ( !$model->save() ) {                    throw new \RuntimeException( 'Saving $model error.' );                }                $price->ad_id = $model->id;                $price->currency_id = $currency->short_name;                $price->price = str_replace( ' ', '', $price->price );//                $price->price = printf( '%d', $price->price );                $price->price = (int)$price->price;                if ( !$price->save() ) {                    print_r($price->getErrors());                    throw new \RuntimeException( 'Saving $price error.' );                }                UserPhones::deleteAll( [ 'ad_id' => $model->id ] );                $this->saveUserPhones( $phones, $model->id );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;            } catch ( \Throwable $e ){                $transaction->rollBack();                throw $e;            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        else {            return $this->render( 'update', [                'model'           => $model,                'price'           => $price,                'currency'        => $currency,                'currencyList'    => $currencyList,                'phonesArray'     => $phonesArray,                'images'          => $images,            ] );        }    }    /**     * @param $phones     * @param $id     */    private function saveUserPhones( $phones, $id )    {        foreach ( $phones->phone as $key => $val ) {            if ( $val != '' ) {                $userphones = new UserPhones();                $userphones->ad_id = $id;                $userphones->user_id = Yii::$app->user->id;                $userphones->phone = $val;                $userphones->sort = $key;                $userphones->isNewRecord = true;                if ( !$userphones->save() ) {                    d($userphones->getErrors());                    throw new \RuntimeException( 'Saving $userphones error.' );                }            }        }    }    /**     * @param $id     * @return yii\web\Response     */    public function actionSave( $id )    {        $model = $this->findModel( $id );        // Если объявление уже было сохранено... draft = 0        if ( $model->draft == Adverts::STATUS_PUBLISHED ) {            $model->has_images = $this->_hasImages( $id ); //var_dump( $model->has_images ); die;            if ( !$model->save() ) {                return $this->redirect( [ 'preview', 'id' => $model->id ] );            }            return $this->redirect( [ 'success', ] );        }        $model->draft = Adverts::STATUS_PUBLISHED;        $model->has_images = $this->_hasImages( $id );        if ( !$model->save() ) {            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        // TODO:        return $this->redirect( [ 'success', ] );    }    /**     * @param $id     * @param $model     * @return int     */    protected function _hasImages( $id )    {        $images = Images::find()->where( [ 'ad_id' => $id ] )->exists();        $images ? $result = Adverts::HAS_IMAGES : $result = Adverts::HAS_NOT_IMAGES;        return $result;    }    /**     * @return string     */    public function actionSuccess()    {        return $this->render( 'success' );    }    /**     * @param $id     * @return string|yii\web\Response     */    public function actionView( $id )    {        $advert = $this->findModel( $id );        $imagesForm = new ImageForm();        if ( $imagesForm->load( Yii::$app->request->post() ) && $imagesForm->validate() ) {            try{                $this->_service->addPhotos( $advert->id, $imagesForm );                return $this->redirect( [ 'view', 'id' => $advert->id ] );            } catch ( \DomainException $e ){                Yii::$app->errorHandler->logException( $e );                Yii::$app->session->setFlash( 'error', $e->getMessage() );            }        }        return $this->render( 'view', [            'advert'     => $advert,            'imagesForm' => $imagesForm,        ] );    }    protected function findUpdateModel( $id )    {        $model = Adverts::find()            ->joinWith( [                'price p' => function ( $q ){                    $q->joinWith( 'currencies c' );                }            ] )            ->where( [ 'adverts.id' => $id ] )            ->one();        return $model;    }    protected function findModel( $id )    {        if ( ( $model = Adverts::findOne( $id ) ) !== null ) {            return $model;        }        throw new NotFoundHttpException( 'The requested page does not exist.' );    }}