<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts`.
 */
class m171109_195425_create_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%adverts}}', [
            'id'  => $this->primaryKey(),
            'old_id' => $this->integer()->notNull()->unique(),
            'sid' => $this->string( 32 )->notNull()->unique(),
            'cat_id' => $this->integer(3)->notNull(),
            'subcat_id' => $this->integer(3)->notNull(),
            'type' => $this->integer(2)->notNull(),
            'header' => $this->string(255)->notNull(),
            'comment' => $this->text(),
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

        $this->addForeignKey( 'fk-type', '{{%adverts}}', 'type', '{{%type}}', 'id' );
        $this->addForeignKey( 'fk-category_id', '{{%adverts}}', 'cat_id', '{{%category}}', 'id' );
        $this->addForeignKey( 'fk-subcat_id', '{{%adverts}}', 'subcat_id', '{{%subcategory}}', 'id' );
        $this->addForeignKey( 'fk-city_id', '{{%adverts}}', 'city', '{{%country}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%adverts}}' );
    }
}
