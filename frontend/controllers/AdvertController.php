<?php

namespace frontend\controllers;

use yii;
use board\forms\AdvertCreateForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use board\manage\AdvertManageService;

class AdvertController extends \yii\web\Controller
{
    public $layout = 'blank';

    private $service;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'login', 'error', 'create' ],
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
        $this->service = $service;
    }

    public function actionIndex()
    {
        return $this->render( 'index' );
    }

    public function actionCreate()
    {
        $form = new AdvertCreateForm();

        // TODO:
        if ( $form->load( Yii::$app->request->post() ) && $form->validate() ) {
            try{
                $advert = $this->service->create( $form );
                return $this->redirect( [ 'view', 'id' => $advert->id ] );
            } catch ( \DomainException $e ){
                Yii::$app->errorHandler->logException( $e );
                Yii::$app->session->setFlash( 'error', $e->getMessage() );
            }
        }

        return $this->render( 'create', [
            'model' => $form,
        ] );
    }

}
