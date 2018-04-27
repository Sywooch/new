<?php
/**
 * File: ImageCleanerController.php
 * Email: becksonq@gmail.com
 * Date: 12.01.2018
 * Time: 20:56
 */

namespace console\controllers;


use Yii;
use frontend\models\Images;
use yii\console\Controller;
use yii\helpers\FileHelper;

class ImageCleanerController extends Controller
{
    public $tempFolder = '@frontend/web/img/temp';

    /**
     * Метод удаляет изображения не принадлежащие объявлениям
     * @return int
     */
    public function actionClean()
    {
        // Находим изображения непринадлежащие к опубликованным объявлениям
        $images = Images::find()->where( [ 'ad_id' => null ] )->all();
        if ( !empty( $images ) ) {
            foreach ( $images as $val ) {
                $directory = Yii::getAlias( $this->tempFolder ) . DIRECTORY_SEPARATOR . $val->sid;

                if ( is_file( $directory . DIRECTORY_SEPARATOR . $val->filename ) ) {
                    unlink( $directory . DIRECTORY_SEPARATOR . $val->filename );
                    $this->stdout( 'File removed from disk!' . PHP_EOL );
                }

                if ( $val->delete() ) {
                    $this->stdout( 'File deleted from table!' . PHP_EOL );
                }
            }
        }
        else {
            $this->stdout( 'No images!' . PHP_EOL );
        }

        $this->stdout( 'All done!' . PHP_EOL );
        return 0;
    }

    /**
     * Находим изображения не принадлежащие объявлениям
     * @return int
     */
    public function actionOrphanImages()
    {
        // Массив изображений в таблице
        $filenamesArray = [];
        // Массив папок sid в таблице
        $sidArray = [];

        // Все изображения в таблице
        $orphanImages = Images::find()->asArray()->all();
        // Массив папок в директории tmp
        $tmpArray = array_diff( scandir( Yii::getAlias( $this->tempFolder ) ), [ '.', '..' ] );

        foreach ( $orphanImages as $image ):
            $filenamesArray[] = $image['filename'];
            $sidArray[] = $image['sid'];
        endforeach;

        $sidArray = array_unique( $sidArray );

        foreach ( $tmpArray as $folder ) :
            // Если папка в директории tmp совпадает с папкой в таблице...
            if ( in_array( $folder, $sidArray ) ) {
                $directory = Yii::getAlias( $this->tempFolder ) . DIRECTORY_SEPARATOR . $folder;
                // Находим массивы изображений в каждой папке sid
                $imgArrays = array_diff( scandir( $directory ), [ '.', '..' ] );

                // Если изображения в папке sid нет в таблице...
                foreach ( $imgArrays as $val ) :
                    if ( !in_array( $val, $filenamesArray ) ) {
                        unlink( $directory . DIRECTORY_SEPARATOR . $val );
                        $this->stdout( 'File removed from disk!' . PHP_EOL );
                    }
                endforeach;
            }
            else {
                // Если папки в директории tmp нет в таблице...
                $directory = Yii::getAlias( $this->tempFolder ) . DIRECTORY_SEPARATOR . $folder;
                foreach ( array_diff( scandir( $directory ), [ '.', '..' ] ) as $item ) {
                    unlink( $directory . DIRECTORY_SEPARATOR . $item );
                }
                if ( rmdir( $directory ) ) {
                    $this->stdout( 'Folder removed!' . PHP_EOL );
                }
            }
        endforeach;

        $this->stdout( PHP_EOL . 'All done!' . PHP_EOL );
        return 0;
    }

    /**
     * Метод удаляет пустые папки
     * @return int
     */
    public function actionCleanFolder()
    {
        $tmpArray = array_diff( scandir( Yii::getAlias( $this->tempFolder ) ), [ '.', '..' ] );
        foreach ( $tmpArray as $value ) {
            $folder = Yii::getAlias( $this->tempFolder . DIRECTORY_SEPARATOR . $value );
            if ( [] === ( array_diff( scandir( $folder ), [ '.', '..' ] ) ) ) {
                if ( rmdir( $folder ) ) {
                    $this->stdout( 'Folder removed!' . PHP_EOL );
                }
            }
            else {
                $this->stdout( 'No empty folders!' . PHP_EOL );
            }
        }
        return 0;
    }
}