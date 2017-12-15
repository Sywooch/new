<?php
/**
 * User: beckson
 * Date: 15.12.2017
 * Time: 12:48
 * Email: becksonq@gmail.com
 */

namespace frontend\controllers;

use frontend\models\Images;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;

class ImagesController extends Controller
{
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
                $model->avatar = $imageFile->name;
                $model->filename = $fileName;
                $model->image = $fileName;
                $model->path = $folder;
                if( !$model->save() ){
                    // Если не удалось сохранить модель, удаляем загруженные файлы
                    $this->actionImageDelete( $fileName );
                    return Json::encode([
                        'files' => [
                            [
                                'error' => 'Файл уже загружен',
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

        $files = FileHelper::findFiles( $directory );
        $output = [];
        foreach ( $files as $file ) {
            $fileName = basename( $file );
            $path = '/img/temp/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;
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
}