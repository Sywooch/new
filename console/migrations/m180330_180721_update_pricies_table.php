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
        $this->renameColumn( '{{%pricies}}', 'price', 'price_name' );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->renameColumn( '{{%pricies}}', 'price_name', 'price' );
    }
}
