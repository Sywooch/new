<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.11.2017
 * Time: 13:35
 */

namespace board\repositories;

use board\dispatchers\EventDispatcher;
use board\entities\Advert;
use board\repositories\events\EntityPersisted;

class AdvertsRepository
{
    private $dispatcher;

    public function __construct( EventDispatcher $dispatcher )
    {
        $this->dispatcher = $dispatcher;
    }

    public function save( Advert $advert )
    {
        if ( !$advert->save() ) {
            throw new \RuntimeException( 'Saving error.' );
        }

        $this->dispatcher->dispatchAll( $advert->releaseEvents() );
        $this->dispatcher->dispatch( new EntityPersisted( $advert ) );
    }

    public function get( $id )
    {
        if ( !$product = Advert::findOne( $id ) ) {
            throw new \DomainException( 'Product is not found.' );
        }
        return $product;
    }
}