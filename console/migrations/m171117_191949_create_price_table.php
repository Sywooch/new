<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m171117_191949_create_price_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( 'price', [
            'id'         => $this->primaryKey(),
            'ad_id'      => $this->integer(),
            'price'      => $this->integer(),
            'price_old'  => $this->integer(),
            'currency'   => $this->integer( 1 ),
            'negotiable' => $this->string( 2 ),
        ], $tableOptions );

        $this->addForeignKey( 'fk-currency', '{{%price}}', 'currency', '{{%currency}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( 'price' );
    }
}
