<?php

use yii\db\Migration;

/**
 * Class m180330_180721_update_pricies_table
 */
class m180330_180721_update_pricies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn( '{{%pricies}}', 'price', 'price_value' );
        $this->alterColumn( '{{%pricies}}', 'price_value', $this->string( 10 ) );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn( '{{%pricies}}', 'price_value', $this->integer() );
        $this->renameColumn( '{{%pricies}}', 'price_value', 'price' );
    }
}
