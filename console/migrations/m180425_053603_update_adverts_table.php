<?php

use yii\db\Migration;

/**
 * Class m180425_053603_update_adverts_table
 */
class m180425_053603_update_adverts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey( 'fk-adverts_categories', '{{%adverts}}', 'cat_id', '{{%categories}}', 'id' );
        $this->addForeignKey( 'fk-adverts_subcategories', '{{%adverts}}', 'subcat_id', '{{%subcategories}}', 'id' );
        $this->addForeignKey( 'fk-adverts_types', '{{%adverts}}', 'type_id', '{{%types}}', 'id' );
        $this->addForeignKey( 'fk-adverts_periods', '{{%adverts}}', 'period_id', '{{%periods}}', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk-adverts_categories', '{{%adverts}}' );
        $this->dropForeignKey( 'fk-adverts_subcategories', '{{%adverts}}' );
        $this->dropForeignKey( 'fk-adverts_types', '{{%adverts}}' );
        $this->dropForeignKey( 'fk-adverts_periods', '{{%adverts}}' );
    }
}
