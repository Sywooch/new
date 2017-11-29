<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 14:39
 * Email: becksonq@gmail.com
 */

namespace board\entities;


trait EventTrait
{
    private $events = [];

    protected function recordEvent( $event )
    {
        $this->events[] = $event;
    }

    /**
     * @return array
     */
    public function releaseEvents()
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}