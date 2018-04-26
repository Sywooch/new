<?php

use yii\db\Migration;

/**
 * Class m180426_154947_update_adverts_table
 */
class m180426_154947_update_adverts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( '{{%adverts}}', 'user_id', $this->integer()->after( 'author' )->defaultValue( null ) );
        $this->addForeignKey( 'fk-adverts-user', '{{%adverts}}', 'user_id', 'user', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk-adverts-user', '{{%adverts}}' );
        $this->dropColumn( '{{%adverts}}', 'user_id' );
    }
}
