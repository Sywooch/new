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
use yii\console\Controller;
use yii\data\ActiveDataProvider;

class CopyAdvertsController extends Controller
{
    public function actionCopyOldAd()
    {
        $advert = new Advert();
        $query = $advert->find()->asArray()->all();

        foreach ( $query as $value ) {
//            print_r( $value['AdvertID'] . "\n" );
            $adverts = new Adverts();

            $adverts->old_id = $value['AdvertID'];
            $adverts->sid = $value['AdvertsID'];
            $adverts->cat_id = $value['AdvertID']; //TODO:
            $adverts->subcat_id = $value['AdvertID']; //TODO:
            $adverts->type = $value['AdvertType'];
            $value['AdvertHeader'] !== '' ? $adverts->header = $value['AdvertHeader'] : $adverts->header = '---';
            $adverts->comment = $value['AdvertComment'];
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

            if ( $adverts->validate() ) {
                if ( !$adverts->save() ) {
                    $this->stdout( "Can't save advert " . $value['AdvertID'] . PHP_EOL );
                }
            }
        }

        return 0;
    }

    private function convertCategory(){

    }

    private function convertType( $arg )
    {
        $type = '';

        switch ( $arg ) {
            case 1:
                $type = 'Продам';
                break;
            case 2:
                $type = 'Сдам';
                break;
            case 3:
                $type = 'Сниму';
                break;
            case 4:
                $type = 'Предлагаю';
                break;
            case 5:
                $type = 'Воспользуюсь';
                break;
            case 6:
                $type = 'Ищу';
                break;
            case 7:
                $type = 'Отдам';
                break;
            case 8:
                $type = 'Приму в дар';
                break;
            case 9:
                $type = 'Обменяю';
                break;
        }

        return $type;
    }

}