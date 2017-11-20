<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_phones`.
 */
class m171115_153058_create_user_phones_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%user_phones}}', [
            'id'      => $this->primaryKey(),
            'user_id' => $this->integer(),
            'ad_id'   => $this->integer(),
            'phone'   => $this->integer( 15 ),
            'sort'    => $this->integer( 2 ),
        ], $tableOptions );

        //$this->addForeignKey( 'fk-user_id', '{{%user_phones}}', 'user_id', 'user', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( 'user_phones' );
    }
}
