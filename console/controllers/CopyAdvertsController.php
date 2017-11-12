<?php
/**
 * File: CopyAdverts.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 15:47
 */

namespace console\controllers;


use backend\models\Advert;
use backend\models\Adverts;
use backend\models\Subcategory;
use yii\console\Controller;
use yii\data\ActiveDataProvider;

class CopyAdvertsController extends Controller
{
    public function actionCopyOldAd()
    {
        $advert = new Advert();
        $query = $advert->find()->asArray()->all();

        foreach ( $query as $value ) {

            $adverts = new Adverts();

            $adverts->old_id = $value['AdvertID'];
            $adverts->sid = $value['AdvertsID'];
            $adverts->cat_id = $this->convertCategory( $value['AdvertFolder'] );
            $adverts->subcat_id = $this->convertSubcategory( $value['AdvertFolder'] );
            $adverts->type = $value['AdvertType'];
            $value['AdvertHeader'] !== '' ? $adverts->header = $value['AdvertHeader'] : $adverts->header = '---';
            $adverts->description = $value['AdvertComment'];
            $adverts->city = $value['AdvertCity'];
            $adverts->price = $value['AdvertPrice'];
            $adverts->period = $value['AdvertPeriod'];
            $adverts->active = $value['AdvertActive'];
            $adverts->selected = $value['AdvertSelected'];
            $adverts->special = $value['AdvertSpecial'];
            $adverts->images = $value['AdvertImg']; // TODO:
            $value['AdvertIPAdress'] != null ? $adverts->ip = $value['AdvertIPAdress'] : $adverts->ip = 1414544319;
            $adverts->created_at = $value['AdvertTime'];
            $adverts->updated_at = $value['AdvertTimeOriginated'];

            if ( !$adverts->save() ) {
                $this->stdout( "Can't save advert " . $value['AdvertID'] . PHP_EOL );
            } else {
                $this->stdout( 'Process...' . PHP_EOL );
            }
        }

        $this->stdout( 'Done!' . PHP_EOL );
        return 0;
    }


    private function convertCategory( $AdvertFolder )
    {
        $cat_id = '';
        $subcategory = new Subcategory();
        $query = $subcategory->find()->asArray()->all();

        foreach ( $query as $val ) {
            // TODO: если категория -1, то это верхний уровень, записи не будет
            // объявление пришло из губернии
            if ( $val['old_id'] == $AdvertFolder ) {
                $cat_id = $val['cat_id'];
            }
        }

        return $cat_id;
    }

    private function convertSubcategory( $AdvertFolder ){
        $subcut_id = '';
        $subcategory = new Subcategory();
        $query = $subcategory->find()->asArray()->all();

        foreach ( $query as $val ){
            if( $val['old_id'] == $AdvertFolder ){
                $subcut_id = $val['id'];
            }
        }

        return $subcut_id;
    }
}