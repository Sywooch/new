<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m171117_043336_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'short_name' => $this->string()->unique()->notNull(),
            'name' => $this->string()->notNull(),
            'value' => $this->integer(),

        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency');
    }
}
