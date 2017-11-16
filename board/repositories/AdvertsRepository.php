<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.11.2017
 * Time: 13:35
 */

namespace board\repositories;

use board\dispatchers\EventDispatcher;
use board\entities\Adverts;
use board\repositories\events\EntityPersisted;

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
}