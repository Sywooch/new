<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 15.11.2017
 * Time: 14:13
 */

namespace board\entities;


interface AggregateRoot
{
    /**
     * @return array
     */
    public function releaseEvents();
}