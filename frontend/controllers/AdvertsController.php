<?phpnamespace frontend\controllers;use board\repositories\AdvertsRepository;use yii;use yii\filters\VerbFilter;use yii\filters\AccessControl;use board\manage\AdvertManageService;use board\entities\Adverts;use yii\web\NotFoundHttpException;use board\forms\ImageForm;use backend\models\Pricies;use frontend\models\UserPhones;use backend\models\Currencies;class AdvertsController extends \yii\web\Controller{    public $layout = 'blank';    private $_service;    public function behaviors()    {        return [            'access' => [                'class' => AccessControl::className(),                'rules' => [                    [                        'actions' => [                            'login',                            'error',                            'create',                            'subcat',                            'preview',                            'save',                            'success',                            'update',                            'subcategory-page'                        ],                        'allow'   => true,                    ],                    [                        'actions' => [ 'logout', 'index', 'view' ],                        'allow'   => true,                        'roles'   => [ '@' ],                    ],                ],            ],            'verbs'  => [                'class'   => VerbFilter::className(),                'actions' => [                    'delete' => [ 'POST' ],                ],            ],        ];    }    public function actions()    {        return [//            'captcha' => [//                'class' => 'common\components\MathCaptchaAction',//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,//            ],        ];    }    /**     * AdvertsController constructor.     * @param string $id     * @param yii\base\Module $module     * @param AdvertManageService $service     * @param array $config     */    public function __construct( $id, $module, AdvertManageService $service, $config = [] )    {        parent::__construct( $id, $module, $config );        $this->_service = $service;    }    /**     * @return string     */    public function actionIndex()    {        return $this->render( 'index' );    }    public function actionCreate()    {        $model = new Adverts();        $categoryList = AdvertsRepository::categoryList();        $typeList = AdvertsRepository::typeList();        $periodList = AdvertsRepository::periodList();        $countryList = AdvertsRepository::countryList();        $price = new Pricies();        $currencyList = AdvertsRepository::currencyList();        $currency = new Currencies();        $phones = new UserPhones();        if ( $model->load( Yii::$app->request->post() )            && $price->load( Yii::$app->request->post() )            && $phones->load( Yii::$app->request->post() )            && $currency->load( Yii::$app->request->post() )        ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                $model->sid = AdvertsRepository::getSid();                $model->ip = AdvertsRepository::getIp();                if ( !$model->save() ) {                    throw new \RuntimeException( 'Saving $model error.' );                }                $price->ad_id = $model->id;                $price->currency_id = $currency->short_name;                if ( !$price->save() ) {                    throw new \RuntimeException( 'Saving $price error.' );                }                $this->saveUserPhones( $phones, $model->id );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;//                var_dump( $model->getErrors() );//                die();            } catch ( \Throwable $e ){                $transaction->rollBack();//                \Yii::$app->session->setFlash('error','DB Error');                throw $e;//                var_dump( $model->getErrors() );//                die();            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        else {            return $this->render( 'create', [                'model'    => $model,                'category' => $categoryList,                'type'     => $typeList,                'period'   => $periodList,                'country'  => $countryList,                'price'    => $price,                'currency' => $currencyList,                'phones'   => $phones,            ] );        }    }    public function actionPreview( $id )    {        $model = Adverts::find()            ->select( 'adverts.*' )            ->where( [ 'adverts.id' => $id ] )            ->joinWith( 'category' )            ->joinWith( 'subcategory' )            ->joinWith( 'types' )            ->joinWith( 'periods' )            ->joinWith( 'countries' )            ->one();        $price = Pricies::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currencies' )->one();        $phones = UserPhones::find()->where( [ 'ad_id' => $id ] )->orderBy( 'sort' )->all();        return $this->render( 'preview', [            'model'  => $model,            'price'  => $price,            'phones' => $phones,        ] );    }    public function actionUpdate( $id )    {        $currency = new Currencies();        $phones = new UserPhones();        $model = $this->findModel( $id );        $categoryList = AdvertsRepository::categoryList();        $advertsRepo = new AdvertsRepository();        $subcategoryList = $advertsRepo->subcategoryListUpdate( $model->cat_id );        $typeList = AdvertsRepository::typeList();        $countryList = AdvertsRepository::countryList();        $periodList = AdvertsRepository::periodList();        $currencyList = AdvertsRepository::currencyList();        $price = Pricies::find()->where( [ 'ad_id' => $id ] )->joinWith( 'currencies' )->one();        $phonesArray = UserPhones::find()->where( [ 'ad_id' => $id ] )->all();        if ( $model->load( Yii::$app->request->post() )            && $price->load( Yii::$app->request->post() )            && $phones->load( Yii::$app->request->post() )            && $currency->load( Yii::$app->request->post() )        ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                $model->sid = AdvertsRepository::getSid();                $model->ip = AdvertsRepository::getIp();                if ( !$model->save() ) {                    throw new \RuntimeException( 'Saving $model error.' );                }                $price->ad_id = $model->id;                $price->currency_id = $currency->short_name;                if ( !$price->save() ) {                    throw new \RuntimeException( 'Saving $price error.' );                }                UserPhones::deleteAll( [ 'ad_id' => $model->id ] );                $this->saveUserPhones( $phones, $model->id );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;            } catch ( \Throwable $e ){                $transaction->rollBack();                throw $e;            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        else {            return $this->render( 'update', [                'categoryList'    => $categoryList,                'subcategoryList' => $subcategoryList,                'typeList'        => $typeList,                'periodList'      => $periodList,                'countryList'     => $countryList,                'model'           => $model,                'price'           => $price,                'currency'        => $currencyList,                'phonesArray'     => $phonesArray,            ] );        }    }    /**     * @param $phones     * @param $id     */    private function saveUserPhones( $phones, $id )    {        foreach ( $phones->phone as $key => $val ) {            if ( $val != '' ) {                $userphones = new UserPhones();                $userphones->ad_id = $id;                $userphones->user_id = Yii::$app->user->id;                $userphones->phone = $val;                $userphones->sort = $key;                $userphones->isNewRecord = true;                if ( !$userphones->save() ) {                    throw new \RuntimeException( 'Saving $userphones error.' );                }            }        }    }    public function actionSave( $id )    {        $model = $this->findModel( $id );        if ( $model->draft == 0 ) {            return $this->redirect( [ 'success', ] );        }        $model->draft = 0;        if ( !$model->save() ) {            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        // TODO:        return $this->redirect( [ 'success', ] );    }    /**     * @return string     */    public function actionSuccess()    {        return $this->render( 'success' );    }    /**     * @param $id     * @return string|yii\web\Response     */    public function actionView( $id )    {        $advert = $this->findModel( $id );        $imagesForm = new ImageForm();        if ( $imagesForm->load( Yii::$app->request->post() ) && $imagesForm->validate() ) {            try{                $this->_service->addPhotos( $advert->id, $imagesForm );                return $this->redirect( [ 'view', 'id' => $advert->id ] );            } catch ( \DomainException $e ){                Yii::$app->errorHandler->logException( $e );                Yii::$app->session->setFlash( 'error', $e->getMessage() );            }        }        return $this->render( 'view', [            'advert'     => $advert,            'imagesForm' => $imagesForm,        ] );    }    protected function findModel( $id )    {        if ( ( $model = Adverts::findOne( $id ) ) !== null ) {            return $model;        }        throw new NotFoundHttpException( 'The requested page does not exist.' );    }}