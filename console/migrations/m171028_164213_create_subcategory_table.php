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
            'cut_id'      => $this->integer( 2 )->notNull()->unique(),
            'subcat_name' => $this->string( 50 )->notNull()->unique(),
            'menu_order'  => $this->integer( 2 )->notNull()->unique(),
        ] );

        $this->addForeignKey( 'fk-subcat-catefory_id', 'subcategory', 'cut_id', 'category', 'id', 'CASCADE' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subcategory');
    }
}
