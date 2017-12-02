<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subcategory`.
 */
class m171028_164213_create_subcategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%subcategory}}', [
            'id'          => $this->primaryKey(),
            'old_id'      => $this->integer( 3 )->notNull()->unique(),
            'old_cat_id'  => $this->integer( 3 )->notNull(),
            'cat_id'      => $this->integer( 2 )->notNull(),
            'subcat_name' => $this->string( 50 )->notNull(),
            'sort'  => $this->integer( 2 )->notNull(),
        ] , $tableOptions);

        $this->addForeignKey( 'fk-subcat-category', 'subcategory', 'cat_id', 'category', 'id', 'CASCADE' );
        $this->addForeignKey( 'fk-subcut-oldcategory', 'subcategory', 'old_cat_id', 'category', 'old_id',
            'CASCADE' );
//        $this->addForeignKey( 'fk-subcat_id', '{{%subcategory}}', 'id', '{{%adverts}}', 'subcat_id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%subcategory}}' );
    }
}
