<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.11.2017
 * Time: 13:56
 */

namespace board\dispatchers;


interface EventDispatcher
{
    public function dispatchAll( $events );

    public function dispatch( $event );
}