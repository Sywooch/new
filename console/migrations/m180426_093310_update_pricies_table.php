<?php

use yii\db\Migration;

/**
 * Class m180426_093310_update_pricies_table
 */
class m180426_093310_update_pricies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn( '{{%pricies}}', 'price_value', $this->integer()->defaultValue( 0 ) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn( '{{%pricies}}', 'price_value', $this->string() );
    }
}
