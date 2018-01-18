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
    /**
     * Метод удаляет изображения не принадлежащие объявлениям
     * @return int
     */
    public function actionClean()
    {
        // Находим картинки непринадлежащие к опубликованным объявлениям
        $images = Images::find()->where( [ 'ad_id' => null ] )->all();

        foreach ( $images as $val ) {

            $directory = Yii::getAlias( '@frontend/web/img/temp' ) . DIRECTORY_SEPARATOR . $val->sid;

            if ( is_file( $directory . DIRECTORY_SEPARATOR . $val->filename ) ) {
                unlink( $directory . DIRECTORY_SEPARATOR . $val->filename );
                $this->stdout( 'File removed from disk!' . PHP_EOL );
            }

            if( Yii::$app->db->createCommand()->delete( 'images',
                [ 'sid' => $val->sid, 'filename' => $val->filename, ] )->execute() ){
                $this->stdout( 'File deleted from table!' . PHP_EOL );
            }
        }

        $this->stdout( 'All done!' . PHP_EOL );
        return 0;
    }

    /**
     * Метод удаляет изображения из папки которых нет в базе данных
     */
    public function actionCleanFolder()
    {

    }
}