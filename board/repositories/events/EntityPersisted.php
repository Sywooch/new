<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 16:15
 * Email: becksonq@gmail.com
 */

namespace board\repositories\events;


class EntityPersisted
{
    public $entity;

    public function __construct( $entity )
    {
        $this->entity = $entity;
    }
}