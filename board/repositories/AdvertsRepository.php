<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.11.2017
 * Time: 13:35
 */

namespace board\repositories;

use yii;
use board\dispatchers\EventDispatcher;
use board\entities\Adverts;
use board\repositories\events\EntityPersisted;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\models\Subcategory;
use common\models\Helpers;
use backend\models\Currencies;
use backend\models\Category;
use backend\models\Types;
use backend\models\Periods;
use backend\models\Countries;
use backend\models\Pricies;
use frontend\models\UserPhones;

class AdvertsRepository
{
    private $_dispatcher;
    public $model;

    /*public function __construct( EventDispatcher $dispatcher )
    {
        $this->_dispatcher = $dispatcher;
    }*/

    /*public function save( Adverts $advert )
    {
        if ( !$advert->save() ) {
            throw new \RuntimeException( 'Saving error.' );
        }

//        $this->_dispatcher->dispatchAll( $advert->releaseEvents() );
//        $this->_dispatcher->dispatch( new EntityPersisted( $advert ) );
    }*/

    public function createAdvertForm(){
        $this->model = new Adverts();
        $this->model->_category = self::categoryList();
        $this->model->type = self::typeList();
        $this->model->_period = self::periodList();
        $this->model->_city = self::countryList();
        $this->model->price = new Pricies();
        $this->model->_currency = self::currencyList();
        $this->model->currency = new Currencies();
        $this->model->phones = new UserPhones();

        return $this->model;
    }

    public function get( $id )
    {
        if ( !$product = Adverts::findOne( $id ) ) {
            throw new \DomainException( 'Product is not found.' );
        }
        return $product;
    }

    /**
     * @return array
     */
    public static function currencyList()
    {
        return ArrayHelper::map( Currencies::find()->orderBy( 'id' )->asArray()->all(), 'id', 'short_name' );
    }

    /**
     * @return array
     */
    public static function categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'category_name' );
    }

    /**
     * @return array
     */
    public static function typeList()
    {
        return ArrayHelper::map( Types::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    /**
     * @return array
     */
    public static function dateList()
    {
        $arr = [
            [ 'id' => 'desc', 'name' => 'Сначала новые' ],
            [ 'id' => 'asc', 'name' => 'Сначала старые' ]
        ];
        return ArrayHelper::map( $arr, 'id', 'name' );
    }

    /**
     * @return array
     */
    public static function priceList()
    {
        $arr = [
            [ 'id' => 'desc', 'name' => 'По убыванию' ],
            [ 'id' => 'asc', 'name' => 'По возрастанию' ]
        ];
        return ArrayHelper::map( $arr, 'id', 'name' );
    }

    /**
     * @return array
     */
    public static function periodList()
    {
        return ArrayHelper::map( Periods::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    /**
     * @return array
     */
    public static function countryList()
    {
        return ArrayHelper::map( Countries::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
    }

    public static function subcatList($cat_id)
    {
        return ArrayHelper::map( Subcategory::find()->where(['cat_id' => $cat_id ])->orderBy('sort')->asArray()->all(), 'id', 'subcat_name' );
    }

    /**
     * Функция для получения подкатегории для DepDrop
     */
    public function getSubcat()
    {
        $out = [];

        if ( Yii::$app->request->post( 'depdrop_parents' ) ) {

            $parents = Yii::$app->request->post( 'depdrop_parents' );

            if ( $parents != null ) {
                $cat_id = $parents[0];
                $out = ArrayHelper::map( Subcategory::find()
                    ->where( [ 'cat_id' => $cat_id ] )
                    ->orderBy( 'sort' )->asArray()->all(),
                    'id', 'subcat_name' );

                echo Json::encode( [ 'output' => $out, 'selected' => '' ] );
                return;
            }
        }

        echo Json::encode( [ 'output' => '', 'selected' => '' ] );
    }

    /**
     * Функция выбора списка подкатегорий для страницы апдейта
     *
     * @param $cat_id
     * @return array
     */
    public static function subcategoryListUpdate( $cat_id )
    {
        return ArrayHelper::map( Subcategory::find()->where( [ 'cat_id' => $cat_id ] )->orderBy( 'sort' )->asArray()->all(),
            'id', 'subcat_name' );
    }
}