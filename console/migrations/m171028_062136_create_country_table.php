<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m171028_062136_create_country_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%country}}', [
            'id'           => $this->primaryKey(),
            'old_id'       => $this->integer( 3 )->notNull(),
            'country_name' => $this->string( 50 )->notNull(),
            'sort'         => $this->integer( 3 )->notNull(),
        ], $tableOptions );

//        $this->addForeignKey( 'fk-city_id', '{{%country}}', 'id', '{{%adverts}}', 'city' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%country}}' );
    }
}
