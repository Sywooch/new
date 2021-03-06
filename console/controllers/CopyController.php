<?php
/**
 * File: CopyAdverts.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 15:47
 *
 * Класс для копирования старых объявлений в новую базу
 * Изменено преобразование ip
 */

namespace console\controllers;


use backend\models\Advert;
use board\entities\Adverts;
use backend\models\Subcategories;
use backend\models\Pricies;
use common\models\Helpers;
use frontend\models\UserPhones;
use yii\console\Controller;
use yii\data\ActiveDataProvider;

class CopyController extends Controller
{
    /**
     * @return int
     * @throws \Exception
     */
    public function actionCopy()
    {
        $advert = new Advert();
        $query = $advert->find()->asArray()->limit( 100 )->all();

        foreach ( $query as $value ) {

            $adverts = new Adverts();
            $pricies = new Pricies();
            $phones = new UserPhones();

            $adverts->old_id = $value['AdvertID'];
            $adverts->sid = $value['AdvertsID'];
            $this->convertCategory( $value['AdvertFolder'] ) !== null
                ? $adverts->cat_id = $this->convertCategory( $value['AdvertFolder'] )
                : $this->stdout( "Can't save cat_id " . $value['AdvertID'] . PHP_EOL );
            $adverts->subcat_id = $this->convertSubcategory( $value['AdvertFolder'] );

            $value['AdvertType'] !== 0 ? $adverts->type = $value['AdvertType'] : $adverts->type = $value['AdvertType'] = 4;
            $value['AdvertHeader'] !== '' ? $adverts->header = $value['AdvertHeader'] : $adverts->header = '---';
            $adverts->description = $value['AdvertComment'];
            $adverts->country = $this->convertCountries( $value['AdvertCity'] );

            $adverts->period = $this->convertPeriod( $value['AdvertPeriod'] );
            $value['AdvertUserName'] !== null ? $adverts->author = $value['AdvertUserName'] : $adverts->author = 'Пользователь';
            $adverts->email = $value['AdvertUserEmail'];
            $adverts->active = $value['AdvertActive'];

            $adverts->selected = 0;
            $value['AdvertSelected'] !== null ? $adverts->selected_old = $value['AdvertSelected'] : $adverts->selected_old = 0;
            $adverts->special = 0;
            $value['AdvertSpecial'] !== null ? $adverts->special_old = $value['AdvertSpecial'] : $adverts->special_old = 0;

            $adverts->images_old = $value['AdvertImg']; // TODO:
//            $value['AdvertIPAdress'] != null ? $adverts->ip = $value['AdvertIPAdress'] : $adverts->ip = 1414544319;

            if($value['AdvertIPAdress'] != null){
                $oldIp = Helpers::NumToIpOld($value['AdvertIPAdress']);
                $adverts->ip = Helpers::IpToNum( $oldIp );
            } else {
                $adverts->ip = 1414544319;
            }

            $adverts->created_at = $value['AdvertTime'];
            $adverts->updated_at = $value['AdvertTimeOriginated'];

            $adverts->draft = 0;

            $value['AdvertPrice'] !== null ? $pricies->price = $value['AdvertPrice'] : $pricies->price = 0;
            $pricies->old_id = $value['AdvertID'];
            $value['AdvertCurrency'] !== null ? $pricies->currency_id = $value['AdvertCurrency'] : $pricies->currency_id = 1;

            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $this->stdout( 'Process...' . PHP_EOL );

                if ( !$adverts->save() ) {
                    $this->stdout( "Can't save advert: " . $value['AdvertID'] . PHP_EOL );
//                    $this->stdout( "sid: " . $adverts->sid . PHP_EOL );
//                    $this->stdout( "cat_id: " . $adverts->cat_id . PHP_EOL );
//                    $this->stdout( "subcut_id: " . $adverts->subcat_id . PHP_EOL );
//                    $this->stdout( "type: " . $adverts->type . PHP_EOL );
//                    $this->stdout( "header: " . $adverts->header . PHP_EOL );
//                    $this->stdout( "desc: " . $value['AdvertComment'] . PHP_EOL );
//                    $this->stdout( "country: " . $adverts->country . PHP_EOL );
//                    $this->stdout( "period: " . $adverts->period . PHP_EOL );
//                    $this->stdout( "user: " . $adverts->author . PHP_EOL );
//                    $this->stdout( "email: " . $adverts->email . PHP_EOL );
//                    $this->stdout( "active: " . $adverts->active . PHP_EOL );
//                    $this->stdout( "selected: " . $adverts->selected_old . PHP_EOL );
//                    $this->stdout( "special: " . $adverts->special_old . PHP_EOL );
//                    $this->stdout( "img: " . $adverts->images_old . PHP_EOL );
//                    $this->stdout( "created: " . $adverts->created_at . PHP_EOL );
//                    $this->stdout( "updated: " . $adverts->updated_at . PHP_EOL );
                }

                if ( $adverts->id !== null ) {
                    $pricies->ad_id = $adverts->id;
                    if ( !$pricies->save() ) {
                        $this->stdout( "Can't save price: " . $value['AdvertID'] . PHP_EOL );
                    }

                    $phones->ad_id = $adverts->id;
                    $phones->phone = $value['AdvertUserPhone'];
                    $phones->sort = 0;
                    if ( !$phones->save() ) {
                        $this->stdout( "Can't save phones: " . $value['AdvertID'] . PHP_EOL );
                    }
                }

                $transaction->commit();
            } catch ( \Exception $e ){
                $transaction->rollBack();
                throw $e;
            }
        }

        $this->stdout( 'Done!' . PHP_EOL );
        return 0;
    }

    /**
     * @param $AdvertFolder
     * @return mixed|string
     */
    private function convertCategory( $AdvertFolder )
    {
        $cat_id = '';
        $subcategory = new Subcategories();
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

    /**
     * @param $AdvertFolder
     * @return mixed|string
     */
    private function convertSubcategory( $AdvertFolder )
    {
        $subcut_id = '';
        $subcategory = new Subcategories();
        $query = $subcategory->find()->asArray()->all();

        foreach ( $query as $val ) {
            if ( $val['old_id'] == $AdvertFolder ) {
                $subcut_id = $val['id'];
            }
        }

        return $subcut_id;
    }

    /**
     * @param $AdvertPeriod
     * @return int
     */
    private function convertPeriod( $AdvertPeriod )
    {
        $period = null;
        switch ( $AdvertPeriod ) {
            case 7:
                $period = 1;
                break;
            case 14:
                $period = 2;
                break;
            case 21:
                $period = 3;
                break;
            case 28:
                $period = 4;
                break;
            case 60:
                $period = 5;
                break;
        }
        return $period;
    }

    private function convertCountries( $AdvertCity )
    {
        $country = null;
        switch ( $AdvertCity ) {
            case 6:
                $country = 1;
                break;
            case 7:
                $country = 1;
                break;
            case 395:
                $country = 2;
                break;
            case 397:
                $country = 3;
                break;
            case 398:
                $country = 4;
                break;
            case 399:
                $country = 5;
                break;
            case 402:
                $country = 6;
                break;
            case 403:
                $country = 7;
                break;
            case 404:
                $country = 8;
                break;
            case 405:
                $country = 9;
                break;
            case 406:
                $country = 10;
                break;
            case 407:
                $country = 11;
                break;
            case 409:
                $country = 12;
                break;
            case 410:
                $country = 13;
                break;
            case 411:
                $country = 14;
                break;
            case 414:
                $country = 15;
                break;
            case 415:
                $country = 16;
                break;
        }

        return $country;
    }
}