<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171028_153846_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'old_id' => $this->integer(2)->notNull()->unique(),
            'category_name' => $this->string(50)->notNull()->unique(),
            'menu_order' => $this->integer(2)->notNull()->unique(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
