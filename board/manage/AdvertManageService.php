<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 15:31
 * Email: becksonq@gmail.com
 */

namespace board\manage;

use board\repositories\AdvertsRepository;
use board\services\TransactionManager;

class AdvertManageService
{
    private $_adverts;
    private $_transaction;

    public function __construct( AdvertsRepository $adverts, TransactionManager $transaction )
    {
        $this->_adverts = $adverts;
        $this->_transaction = $transaction;
    }

}