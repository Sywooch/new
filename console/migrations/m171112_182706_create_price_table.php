<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m171112_182706_create_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable( 'price', [
            'id'         => $this->primaryKey(),
            'price'      => $this->integer(),
            'price_old'  => $this->integer(),
            'currancy'   => $this->integer( 1 ),
            'negotiable' => $this->boolean(),
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( 'price' );
    }
}
