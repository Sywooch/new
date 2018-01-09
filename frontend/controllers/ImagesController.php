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

    public function actionIndex()
    {
        $model = new Images;
        $model->find();

        return $this->render( 'index', [
            'model' => $model,
        ] );
    }

    public function actionImageUpload()
    {
        $model = new Images();

        $imageFile = UploadedFile::getInstance( $model, 'image' );

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

                $model->ad_id = Yii::$app->session->id;
                $model->name = $imageFile->baseName;
                $model->image = $imageFile->name;
                $model->filename = $fileName;
                $model->size = $imageFile->size;
                $model->path = $folder;
                if( !$model->save() ){
                    // Если не удалось сохранить модель, удаляем загруженные файлы
                    $this->actionImageDelete( $fileName );
                    return Json::encode([
                        'files' => [
                            [
//                                'error' => 'Файл уже загружен',
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
                            'deleteUrl'    => 'image-delete?name=' . $fileName,
                            'deleteType'   => 'POST',
                        ],
                    ],
                ] );
            }
        }

        return '';
    }

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
                'deleteUrl'    => 'image-delete?name=' . $fileName,
                'deleteType'   => 'POST',
            ];
        }
        return Json::encode( $output );
    }

    public function beforeAction( $action )
    {
        $this->enableCsrfValidation = ( $action->id !== "uploaded-images" );
        return parent::beforeAction( $action );
    }

    public function actionUploadedImages()
    {
        $output = [];

        if ( Yii::$app->request->isAjax ) {

            $sid = Yii::$app->session->id;
            $images = $this->findImagesBySession( $sid );

            if ( !empty( $images ) ) {
                $output = [ 'images' => $images ];
            }
        }

        return Json::encode( $output );
    }

    public function findImagesBySession( $sid )
    {
//        if ( ( $model = Images::find()->where( [ 'ad_id' => $sid ] )->asArray()->all() ) !== null ) {
        if ( ( $model = Images::findAll( [ 'ad_id' => $sid ] ) ) !== null ) {
            return $model;
        }
        else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    public function deleteModelByName( $filename )
    {
        $sid = Yii::$app->session->id;
        $model = Images::find()->where( [ 'ad_id' => $sid, 'filename' => $filename ] )->one();
        $model->delete();

        return;
    }
}