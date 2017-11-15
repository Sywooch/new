<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 15:35
 * Email: becksonq@gmail.com
 */

namespace board\services;

use board\dispatchers\DeferredEventDispatcher;

class TransactionManager
{
    private $dispatcher;

    public function __construct( DeferredEventDispatcher $dispatcher )
    {
        $this->dispatcher = $dispatcher;
    }

    public function wrap( callable $function )
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $this->dispatcher->defer();
            $function();
            $transaction->commit();
            $this->dispatcher->release();
        } catch ( \Exception $e ){
            $transaction->rollBack();
            $this->dispatcher->clean();
            throw $e;
        }
    }
}