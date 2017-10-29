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
        $this->createTable( 'subcategory', [
            'id'          => $this->primaryKey(),
            'old_id'      => $this->integer( 3 )->notNull()->unique(),
            'old_cat_id'  => $this->integer( 3 )->notNull(),
            'cat_id'      => $this->integer( 2 )->notNull(),
            'subcat_name' => $this->string( 50 )->notNull(),
            'menu_order'  => $this->integer( 2 )->notNull(),
        ] );

        $this->addForeignKey( 'fk-subcat-category_id', 'subcategory', 'cat_id', 'category', 'id', 'CASCADE' );
        $this->addForeignKey( 'fk-subcut-oldcategory_id', 'subcategory', 'old_cat_id', 'category', 'old_id',
            'CASCADE' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( 'subcategory' );
    }
}
