<?php

namespace frontend\controllers;

use yii;
use board\forms\AdvertCreateForm;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AdvertController extends \yii\web\Controller
{
    public $layout = 'blank';

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
                $product = $this->service->create( $form );
                return $this->redirect( [ 'view', 'id' => $product->id ] );
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
