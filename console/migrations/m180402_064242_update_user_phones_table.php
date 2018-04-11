<?php

use yii\db\Migration;

/**
 * Class m180402_064242_update_user_phones_table
 */
class m180402_064242_update_user_phones_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addForeignKey( 'fk-user_phones-user', '{{%user_phones}}', 'user_id', 'user', 'id' );
        $this->addForeignKey( 'fk-user_phones-adverts', '{{%user_phones}}', 'user_id', 'adverts', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk-user_phones-adverts', '{{%user_phones}}' );
        $this->dropForeignKey( 'fk-user_phones-user', '{{%user_phones}}' );
    }
}
