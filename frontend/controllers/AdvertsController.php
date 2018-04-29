<?phpnamespace frontend\controllers;use board\repositories\AdvertsRepository;use Codeception\Lib\Generator\Helper;use common\models\Helpers;use frontend\models\Images;use yii;use yii\filters\VerbFilter;use yii\filters\AccessControl;use board\manage\AdvertManageService;use board\entities\Adverts;use yii\web\NotFoundHttpException;use board\forms\ImageForm;use backend\models\Pricies;use frontend\models\UserPhones;use backend\models\Currencies;class AdvertsController extends \yii\web\Controller{    public $layout = 'blank';    private $_service;    public function behaviors()    {        return [            'access' => [                'class' => AccessControl::className(),                'rules' => [                    [                        'actions' => [                            'login',                            'error',                            'create',                            'subcat',                            'preview',                            'save',                            'success',                            'update',                            'subcategory-page'                        ],                        'allow'   => true,                    ],                    [                        'actions' => [ 'logout', 'index', 'view' ],                        'allow'   => true,                        'roles'   => [ '@' ],                    ],                ],            ],            'verbs'  => [                'class'   => VerbFilter::className(),                'actions' => [                    'delete' => [ 'POST' ],                ],            ],        ];    }    public function actions()    {        return [            'captcha' => [                'class'           => 'common\components\MathCaptchaAction',                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,            ],        ];    }    /**     * AdvertsController constructor.     * @param string $id     * @param yii\base\Module $module     * @param AdvertManageService $service     * @param array $config     */    public function __construct( $id, $module, AdvertManageService $service, $config = [] )    {        parent::__construct( $id, $module, $config );        $this->_service = $service;    }    /**     * @return string     */    public function actionIndex()    {        return $this->render( 'index' );    }    public function actionCreate()    {        $model = new Adverts();        $price = new Pricies();        $phonesArray = $this->_createPhonesModel();        $images = new Images();        if ( !isset( $model, $price, $phonesArray, $images ) ) {            throw new NotFoundHttpException( "Models was not found." );        }        if ( Yii::$app->user->identity ) {            $model->scenario = 'owner';            $model->user_id = Yii::$app->user->identity->id;        }        $post = Yii::$app->request->post();        $validModel = $model->load( $post ) && $model->validate();        $validPhones = UserPhones::loadMultiple( $phonesArray, $post ) && UserPhones::validateMultiple( $phonesArray );        $validPrice = $price->load( $post ) && $price->validate();        if ( $validModel && $validPhones && $validPrice ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                if ( !$model->save() ) {                    throw new \RuntimeException( 'Saving $model error.' );                }                $price->ad_id = $model->id;                if ( !$price->save() ) {                    throw new \RuntimeException( 'Saving $price error.' );                }                $this->_saveUserPhones( $phonesArray, $model->id );                // Сохраняем фото                Images::updateAll( [ 'ad_id' => $model->id ],                    [ 'sid' => Yii::$app->session->id ] );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;            } catch ( \Throwable $e ){                $transaction->rollBack();                throw $e;            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        return $this->render( 'create', [            'model'       => $model,            'price'       => $price,            'phonesArray' => $phonesArray,            'images'      => $images,        ] );    }    public function actionPreview( $id )    {        $model = Adverts::find()            ->select( 'adverts.*' )            ->where( [ 'adverts.id' => $id ] )            ->joinWith( 'category' )            ->joinWith( 'subcategory' )            ->joinWith( 'type' )            ->joinWith( 'period' )            ->joinWith( 'country' )            ->joinWith( [                'price p' => function ( $q ){                    $q->joinWith( 'currency c' );                }            ] )            ->joinWith( [ 'phones' ] )            ->one();        $images = Images::find()->where( [ 'ad_id' => $id, 'sid' => $model->sid ] )->all();        return $this->render( 'preview', [            'model'  => $model,            'images' => $images,        ] );    }    public function actionUpdate( $id )    {        $model = $this->findUpdateModel( $id );        $phonesArray = $this->_createPhonesModel();        $images = new Images();        $price = Pricies::findModel( $id );        if ( !isset( $model, $price, $phonesArray, $images ) ) {            throw new NotFoundHttpException( "Models was not found." );        }        $post = Yii::$app->request->post();        $validModel = $model->load( $post ) && $model->validate();        $validPhones = UserPhones::loadMultiple( $phonesArray, $post ) && UserPhones::validateMultiple( $phonesArray );        $validPrice = $price->load( $post ) && $price->validate();        if ( $validModel && $validPhones && $validPrice ) {            $transaction = \Yii::$app->db->beginTransaction();            try{                if ( !$model->save() ) {                    throw new \RuntimeException( 'Update $model error.' );                }                if ( !$price->save() ) {                    throw new \RuntimeException( 'Update $price error.' );                }                // TODO: обновление полей вместо удаления                UserPhones::deleteAll( [ 'ad_id' => $model->id ] );                $this->_saveUserPhones( $phonesArray, $model->id );                Images::updateAll( [ 'ad_id' => $model->id ], [ 'sid' => $model->sid ] );                $transaction->commit();            } catch ( \Exception $e ){                $transaction->rollBack();                throw $e;            } catch ( \Throwable $e ){                $transaction->rollBack();                throw $e;            }            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        else {            return $this->render( 'update', [                'model'       => $model,                'price'       => $price,                'phonesArray' => $phonesArray,                'images'      => $images,            ] );        }    }    /**     * @param $phonesArray     * @param $id     */    private function _saveUserPhones( $phonesArray, $id )    {        foreach ( $phonesArray as $key => $val ) {            $userPhones = new UserPhones();            $userPhones->ad_id = $id;            $userPhones->user_id = Yii::$app->user->id;            $userPhones->phone = $val->phone;            $userPhones->sort = $key;            $userPhones->isNewRecord = true;            if ( !$userPhones->save( false ) ) {                throw new \RuntimeException( 'Saving $userPhones error.' );            }        }    }    /**     * @return array     */    private function _createPhonesModel()    {        $phonesArray = [ new UserPhones() ];        $count = count( Yii::$app->request->post( 'UserPhones', [] ) );        for ( $i = 1; $i < $count; $i++ ) {            $phonesArray[] = new UserPhones();        }        return $phonesArray;    }    /**     * @param $id     * @return yii\web\Response     */    public function actionSave( $id )    {        $model = $this->findModel( $id );        if ( $model->draft == Adverts::STATUS_PUBLISHED ) {            $model->has_images = $this->_hasImages( $id );            if ( !$model->save() ) {                return $this->redirect( [ 'preview', 'id' => $model->id ] );            }            return $this->redirect( [ 'success', ] );        }        $model->draft = Adverts::STATUS_PUBLISHED;        $model->has_images = $this->_hasImages( $id );        if ( !$model->save() ) {            return $this->redirect( [ 'preview', 'id' => $model->id ] );        }        Yii::$app->mailer->compose(            [ 'html' => 'addAdvSuccess-html', 'text' => 'addAdvSuccess-text' ],            [ 'user' => $model->author, 'id' => $model->id ]        )            ->setFrom( [ Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot' ] )            ->setTo( $model->email )            ->setSubject( 'Adv' )            ->send();        // TODO:        return $this->redirect( [ 'success', ] );    }    /**     * @param $id     * @param $model     * @return int     */    protected function _hasImages( $id )    {        //TODO: посмотреть вариант без обращения в базу        $images = Images::find()->where( [ 'ad_id' => $id ] )->exists();        $images ? $result = Adverts::HAS_IMAGES : $result = Adverts::HAS_NOT_IMAGES;        return $result;    }    /**     * @return string     */    public function actionSuccess()    {        return $this->render( 'success' );    }    /**     * @param $id     * @return string|yii\web\Response     */    public function actionView( $id )    {        $advert = $this->findModel( $id );        $imagesForm = new ImageForm();        if ( $imagesForm->load( Yii::$app->request->post() ) && $imagesForm->validate() ) {            try{                $this->_service->addPhotos( $advert->id, $imagesForm );                return $this->redirect( [ 'view', 'id' => $advert->id ] );            } catch ( \DomainException $e ){                Yii::$app->errorHandler->logException( $e );                Yii::$app->session->setFlash( 'error', $e->getMessage() );            }        }        return $this->render( 'view', [            'advert'     => $advert,            'imagesForm' => $imagesForm,        ] );    }    protected function findUpdateModel( $id )    {        $model = Adverts::find()            ->joinWith( [                'price p' => function ( $q ){                    $q->joinWith( 'currency c' );                }            ] )            ->joinWith( 'phones' )            ->where( [ 'adverts.id' => $id ] )            ->one();        return $model;    }    protected function findModel( $id )    {        if ( ( $model = Adverts::findOne( $id ) ) !== null ) {            return $model;        }        throw new NotFoundHttpException( 'The requested page does not exist.' );    }}