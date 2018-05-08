<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Responses;
use frontend\models\ResponsesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use board\entities\Adverts;

/**
 * ResponsesController implements the CRUD actions for Responses model.
 */
class ResponsesController extends Controller
{
    public function actions()
    {
        return [
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * Lists all Responses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResponsesSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }


    public function actionCreateResponse( $id )
    {
        $responses = new Responses();
        $responses->ad_id = $id;

        if ( $responses->load( Yii::$app->request->post() )
            && $responses->save()
        ) {
            $adverts = Adverts::findOne( $id );
            $adverts->updateCounters( [ 'response_count' => 1 ] );

            Yii::$app->mailer->compose(
                [ 'html' => 'AdvResponse-html', 'text' => 'AdvResponse-text' ],
                [
                    'responses' => $responses,
                    'adverts'   => $adverts,
                ]
            )
                ->setFrom( [ Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot' ] )
                ->setTo( $adverts->email )
                ->setSubject( 'Ответ на объявление ' . $adverts->header )
                ->send();
        }
        return $this->render( '/adverts-views/_response-form', [
            'responses' => $responses,
        ] );
    }

    /**
     * Displays a single Responses model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView( $id )
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new Responses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Responses();

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        return $this->render( 'create', [
            'model' => $model,
        ] );
    }

    /**
     * Updates an existing Responses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel( $id );

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        return $this->render( 'update', [
            'model' => $model,
        ] );
    }

    /**
     * Deletes an existing Responses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete( $id )
    {
        $this->findModel( $id )->delete();

        return $this->redirect( [ 'index' ] );
    }

    /**
     * Finds the Responses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return \frontend\models\Responses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if ( ( $model = Responses::findOne( $id ) ) !== null ) {
            return $model;
        }

        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
