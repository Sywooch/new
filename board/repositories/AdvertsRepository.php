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

class AdvertsRepository
{
    private $_dispatcher;

    /*public function __construct( EventDispatcher $dispatcher )
    {
        $this->_dispatcher = $dispatcher;
    }*/

    public function save( Adverts $advert )
    {
        if ( !$advert->save() ) {
            throw new \RuntimeException( 'Saving error.' );
        }

//        $this->_dispatcher->dispatchAll( $advert->releaseEvents() );
//        $this->_dispatcher->dispatch( new EntityPersisted( $advert ) );
    }

    public function get( $id )
    {
        if ( !$product = Adverts::findOne( $id ) ) {
            throw new \DomainException( 'Product is not found.' );
        }
        return $product;
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