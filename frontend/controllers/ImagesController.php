<?php
/**
 * User: beckson
 * Date: 15.12.2017
 * Time: 12:48
 * Email: becksonq@gmail.com
 */

namespace frontend\controllers;

use board\entities\Image;
use common\models\Helpers;
use frontend\models\Images;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class ImagesController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'uploaded-images' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        // TODO: изменить sid
        $sid = Yii::$app->session->id;

        $model = new Images;
        $model->findAll( [ 'sid' => $sid ] );

        return $this->render( 'index', [
            'model' => $model,
        ] );
    }

    /**
     * @return string
     */
    public function actionImageUpload()
    {
        $model = new Images();

        $imageFile = UploadedFile::getInstance( $model, 'images' );

        $directory = Yii::getAlias( '@frontend/web/img/temp' ) . DIRECTORY_SEPARATOR . Yii::$app->session->id . DIRECTORY_SEPARATOR;
        if ( !is_dir( $directory ) ) {
            FileHelper::createDirectory( $directory );
        }

        if ( $imageFile ) {
            $uid = uniqid( time(), true );
            $fileName = $uid . '.' . $imageFile->extension;
            $filePath = $directory . $fileName;
            if ( $imageFile->saveAs( $filePath ) ) {
                $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
                $folder = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR;

                $model->sid = Yii::$app->session->id;
                $model->filename = $fileName;
                $model->size = $imageFile->size;
                $model->path = $folder;

                !empty( Yii::$app->request->post('marker') ) ? $model->marker = Yii::$app->request->post('marker') : null;
                !empty( Yii::$app->request->post('ad_id') ) ? $model->ad_id = Yii::$app->request->post('ad_id') : null;

                if( !$model->save() ){
                    // Если не удалось сохранить модель, удаляем загруженные файлы
                    $this->actionImageDelete( $fileName );
                    return Json::encode([
                        'files' => [
                            [
                                'error' => Yii::t('app', 'Unable to save picture')
                            ]
                        ]
                    ]);
                }

                return Json::encode( [
                    'files' => [
                        [
                            'name'         => $fileName,
                            'size'         => $imageFile->size,
                            'url'          => $path,
                            'thumbnailUrl' => $path,
                            'deleteUrl'    => '/images/image-delete?name=' . $fileName,
                            'deleteType'   => 'POST',
                        ],
                    ],
                ] );
            }
        }

        return '';
    }

    /**
     * @param $name
     * @return string
     */
    public function actionImageDelete( $name )
    {
        $directory = Yii::getAlias( '@frontend/web/img/temp' ) . DIRECTORY_SEPARATOR . Yii::$app->session->id;
        if ( is_file( $directory . DIRECTORY_SEPARATOR . $name ) ) {
            unlink( $directory . DIRECTORY_SEPARATOR . $name );
        }

        $this->deleteModelByName( $name );

        $files = FileHelper::findFiles( $directory );
        $output = [];
        foreach ( $files as $file ) {
            $fileName = basename( $file );
            $path = '@frontend/web/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
            $output['files'][] = [
                'name'         => $fileName,
                'size'         => filesize( $file ),
                'url'          => $path,
                'thumbnailUrl' => $path,
                'deleteUrl'    => '/images/image-delete?name=' . $fileName,
                'deleteType'   => 'POST',
            ];
        }
        return Json::encode( $output );
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionUploadedImages()
    {
        $output = [];
        $id = Yii::$app->request->post( 'id' );

        // TODO: изменить sid
        $sid = Yii::$app->session->id;

        if ( ( $model = Images::findAll( [ 'ad_id' => $id, 'sid' => $sid ] ) ) !== null ) {

            if ( !empty( $model ) ) {
                $output = [ 'images' => $model ];
            }

            return Json::encode( $output );
        }
        else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    /**
     * @param $sid
     * @return static[]
     * @throws NotFoundHttpException
     */
    public function findImagesBySession( $sid )
    {
        if ( ( $model = Images::findAll( [ 'sid' => $sid ] ) ) !== null ) {
            return $model;
        }
        else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    /**
     * @param $filename
     */
    public function deleteModelByName( $filename )
    {
        // TODO: изменить sid
        $sid = Yii::$app->session->id;
        $model = Images::find()->where( [ 'sid' => $sid, 'filename' => $filename ] )->one();
        $model->delete();

        return;
    }

    protected function findModel( $ad_id, $sid )
    {
        if ( ( $model = Images::findAll( [ 'ad_id' => $ad_id, 'sid' => $sid ] ) ) !== null ) {
            return $model;
        }
        else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}