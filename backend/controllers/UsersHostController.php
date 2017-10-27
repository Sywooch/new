<?php

namespace backend\controllers;

use Yii;
use backend\models\QAuthUser;
use backend\models\QAuthUserSearc;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\UserTmp;

/**
 * UsersHostController implements the CRUD actions for QAuthUser model.
 */
class UsersHostController extends Controller
{
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
     * Lists all QAuthUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QAuthUserSearc();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single QAuthUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView( $id )
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new QAuthUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QAuthUser();

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->QAuthUserID ] );
        }
        else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Updates an existing QAuthUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel( $id );

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->QAuthUserID ] );
        }
        else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Deletes an existing QAuthUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete( $id )
    {
        $this->findModel( $id )->delete();

        return $this->redirect( [ 'index' ] );
    }

    /**
     * Finds the QAuthUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QAuthUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if ( ( $model = QAuthUser::findOne( $id ) ) !== null ) {
            return $model;
        }
        else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    /**
     * Функция для переноса старых пользователей из таблицы QAuthUser
     * в новую таблицу User
     */
    public function actionMoveOldUsers()
    {
        $searchModel = new QAuthUserSearc();
        $provider = $searchModel->searchAll();

        $old_users = $provider->getModels();

        foreach ( $old_users as $key => $val ) {

            $user = new \dektrium\user\models\User();

            $user->username =  $val['QAuthUserEmail'];
            $user->email = $val['QAuthUserEmail'];
            $user->password_hash = '$2y$10$EvE76ImLLtNj5e1YlayN4.zR9JyJyaQdqYXtVU3K6RV4ciNJpj.72';
            $user->auth_key = 'ArYVZMYHd1PgJjkZo2nVtAFGLl5nk6W3';
            $user->confirmed_at = time();
            $user->registration_ip = '127.0.0.1';
            $user->created_at = time();
            $user->updated_at = time();
            $user->flags = 0;
            $user->last_login_at = null;

            if ( !$user->save() ) {
                echo '<pre>';
                print_r( $user->errors );
                echo '</pre>';
            }

            $id = $user->id;

            $name = $val['QAuthUserFullName'];

            Yii::$app->db->createCommand()->update('profile', ['name' => $name ], ['user_id' => $id])->execute();

        }
    }
}
