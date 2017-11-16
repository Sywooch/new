<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts`.
 */
class m171116_195423_create_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%adverts}}', [
            'id'  => $this->primaryKey(),
            'old_id' => $this->integer()->unique()->defaultValue(null),
            'sid' => $this->string( 32 )->notNull()->unique(),
            'cat_id' => $this->integer(3)->notNull(),
            'subcat_id' => $this->integer(3)->notNull(),
            'type' => $this->integer(2)->notNull(),
            'header' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'city' => $this->integer(3)->notNull(),
            'period' => $this->integer(11),
            'author' => $this->string(),
            'email' => $this->string(),
            'active' => $this->boolean()->defaultValue(1),
            'selected' => $this->boolean()->defaultValue(0),
            'selected_old' => $this->boolean()->defaultValue(null),
            'special' => $this->boolean()->defaultValue(0),
            'special_old' => $this->boolean()->defaultValue(null),
            'images_old' => $this->boolean()->defaultValue(null),
            'ip' => $this->integer(11)->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ] , $tableOptions);

        $this->addForeignKey( 'fk-city', '{{%adverts}}', 'city', '{{%country}}', 'id' );
        $this->addForeignKey( 'fk-cat', '{{%adverts}}', 'cat_id', '{{%category}}', 'id' );
        $this->addForeignKey( 'fk-subcat', '{{%adverts}}', 'subcat_id', '{{%subcategory}}', 'id' );
        $this->addForeignKey( 'fk-type', '{{%adverts}}', 'type', '{{%type}}', 'id' );
        $this->addForeignKey( 'fk-period', '{{%adverts}}', 'period', '{{%period}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%adverts}}' );
    }
}
