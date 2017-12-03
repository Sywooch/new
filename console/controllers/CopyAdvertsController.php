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
use backend\models\Pricies;
use yii\console\Controller;
use yii\data\ActiveDataProvider;

class CopyAdvertsController extends Controller
{
    public function actionCopyOldAd()
    {
        $advert = new Advert();
        $query = $advert->find()->asArray()->limit( 100 )->all();

        foreach ( $query as $value ) {

            $adverts = new Adverts();
            $pricies = new Pricies();

            $adverts->old_id = $value['AdvertID'];
            $adverts->sid = $value['AdvertsID'];
            $this->convertCategory( $value['AdvertFolder'] ) !== null
                ? $adverts->cat_id = $this->convertCategory( $value['AdvertFolder'] )
                : $this->stdout( "Can't save cat_id " . $value['AdvertID'] . PHP_EOL );
            $adverts->subcat_id = $this->convertSubcategory( $value['AdvertFolder'] );

            $value['AdvertType'] !== 0 ? $adverts->type = $value['AdvertType'] : $adverts->type = $value['AdvertType'] = 4;
            $value['AdvertHeader'] !== '' ? $adverts->header = $value['AdvertHeader'] : $adverts->header = '---';
            $adverts->description = $value['AdvertComment'];
            $adverts->country = $value['AdvertCity'];

            $adverts->period = $this->convertPeriod( $value['AdvertPeriod'] );
            $value['AdvertUserName'] !== null ? $adverts->author = $value['AdvertUserName'] : $adverts->author = 'Пользователь';
//            $adverts->email = $value['AdvertUserEmail'];
            $adverts->email = 'vasja@pupkin.ru';
            $adverts->active = $value['AdvertActive'];

            $adverts->selected = 0;
            $value['AdvertSelected'] !== null ? $adverts->selected_old = $value['AdvertSelected'] : $adverts->selected_old = 0;
            $adverts->special = 0;
            $value['AdvertSpecial'] !== null ? $adverts->special_old = $value['AdvertSpecial'] : $adverts->special_old = 0;

            $adverts->images_old = $value['AdvertImg']; // TODO:
            $value['AdvertIPAdress'] != null ? $adverts->ip = $value['AdvertIPAdress'] : $adverts->ip = 1414544319;
            $adverts->created_at = $value['AdvertTime'];
            $adverts->updated_at = $value['AdvertTimeOriginated'];

            $adverts->draft = 1;

            $value['AdvertPrice'] !== null ? $pricies->price = $value['AdvertPrice'] : $pricies->price = 0;
            $pricies->old_id = $value['AdvertID'];
            $value['AdvertCurrency'] !== null ? $pricies->currency_id = $value['AdvertCurrency'] : $pricies->currency_id = 1;

            $transaction = \Yii::$app->db->beginTransaction();
            try{
//                $adverts->save();
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
                }

                $transaction->commit();
            } catch ( \Exception $e ){
                $transaction->rollBack();
                throw $e;
            }

//            if ( !$adverts->save() ) {
//                $this->stdout( "Can't save advert " . $value['AdvertID'] . PHP_EOL );
//            }
//            else {
//                $this->stdout( 'Process...' . PHP_EOL );
//            }
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

    /**
     * @param $AdvertFolder
     * @return mixed|string
     */
    private function convertSubcategory( $AdvertFolder )
    {
        $subcut_id = '';
        $subcategory = new Subcategory();
        $query = $subcategory->find()->asArray()->all();

        foreach ( $query as $val ) {
            if ( $val['old_id'] == $AdvertFolder ) {
                $subcut_id = $val['id'];
            }
        }

        return $subcut_id;
    }

    private function convertPeriod( $AdvertPeriod )
    {
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
}