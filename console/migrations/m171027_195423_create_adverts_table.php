<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts`.
 */
class m171027_195423_create_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%adverts}}', [
            'id'  => $this->primaryKey(),
            'old_id' => $this->integer()->unique(),
            'sid' => $this->string( 32 )->notNull()->unique(),
            'cat_id' => $this->integer(3)->notNull(),
            'subcat_id' => $this->integer(3)->notNull(),
            'type' => $this->integer(2)->notNull(),
            'header' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'city' => $this->integer(3)->notNull(),
            'price' => $this->integer(11),
            'period' => $this->integer(11),
            'active' => $this->boolean()->defaultValue(1),
            'selected' => $this->boolean()->defaultValue(0),
            'special' => $this->boolean()->defaultValue(0),
            'images' => $this->boolean()->defaultValue(0),
            'ip' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ] , $tableOptions);

        /*$this->createIndex('{{%adverts-type}}', '{{%adverts}}', 'type');
        $this->createIndex('{{%adverts-cat_id}}', '{{%adverts}}', 'cat_id');
        $this->createIndex('{{%adverts-subcut_id}}', '{{%adverts}}', 'subcat_id');
        $this->createIndex('{{%adverts-city}}', '{{%adverts}}', 'city');*/

//        $this->addForeignKey( 'fk-city', '{{%adverts}}', 'city', '{{%country}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%adverts}}' );
    }
}
