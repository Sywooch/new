<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m171028_062136_create_country_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'old_id' => $this->integer(3)->notNull(),
            'country_name' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('country');
    }
}
