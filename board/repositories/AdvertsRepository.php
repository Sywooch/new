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
use backend\models\Currency;
use backend\models\Category;
use backend\models\Type;
use backend\models\Period;
use backend\models\Country;
use frontend\models\Price;
use frontend\models\UserPhones;

class AdvertsRepository extends yii\db\ActiveRecord
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
        $this->model->price = new Price();
        $this->model->_currency = self::currencyList();
        $this->model->currency = new Currency();
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
     * @return int|number
     */
    public static function getIp()
    {
        return Helpers::IpToNum( Yii::$app->request->userIP );
    }

    /**
     * @return string
     */
    public static function getSid()
    {
        return $sid = md5( time() . rand( 1, 0xFFFFFF ) );
    }

    /**
     * @return array
     */
    public static function currencyList()
    {
        return ArrayHelper::map( Currency::find()->orderBy( 'id' )->asArray()->all(), 'id', 'short_name' );
    }

    /**
     * @return array
     */
    public static function categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'category_name' );
    }

    /**
     * @return array
     */
    public static function typeList()
    {
        return ArrayHelper::map( Type::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    /**
     * @return array
     */
    public static function periodList()
    {
        return ArrayHelper::map( Period::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    /**
     * @return array
     */
    public static function countryList()
    {
        return ArrayHelper::map( Country::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
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
                $out = self::subcategoryList( $cat_id );
                echo Json::encode( [ 'output' => $out, 'selected' => '' ] );
                return;
            }
        }

        echo Json::encode( [ 'output' => '', 'selected' => '' ] );
    }

    /**
     *
     * @param $cat_id
     * @return array
     */
    public function subcategoryList( $cat_id )
    {
        $array = ArrayHelper::map( Subcategory::find()->where( [ 'cat_id' => $cat_id ] )->orderBy( 'menu_order' )->asArray()->all(),
            'id', 'subcat_name' );

        $result = [];
        foreach ( $array as $key => $value ) {
            $result[] = [ 'id' => $key, 'name' => $value ];
        }
        return $result;
    }
}