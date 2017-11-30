<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price`.
 */
class m171117_141949_create_pricies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%pricies}}', [
            'id'          => $this->primaryKey(),
            'ad_id'       => $this->integer(),
            'old_id'      => $this->integer(),
            'price'       => $this->integer(),
            'price_old'   => $this->integer(),
            'currency_id' => $this->integer( 1 ),
            'negotiable'  => $this->boolean()->defaultValue(0),
        ], $tableOptions );

        $this->addForeignKey( 'fk-currency_id', '{{%pricies}}', 'currency_id', '{{%currencies}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%pricies}}' );
    }
}
