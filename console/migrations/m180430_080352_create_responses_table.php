<?php

use yii\db\Migration;

/**
 * Handles the creation of table `responses`.
 */
class m180430_080352_create_responses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%responses}}', [
            'id'      => $this->primaryKey(),
            'ad_id'   => $this->integer(),
            'name'    => $this->string( 120 ),
            'email'   => $this->string( 120 ),
            'phone'   => $this->string( 20 ),
            'message' => $this->text(),
        ], $tableOptions );

        $this->addColumn( '{{%adverts}}', 'response_count', $this->integer()->defaultValue( 0 ) );
        $this->addForeignKey( 'fk-responses-adverts', '{{%responses}}', 'ad_id', '{{%adverts}}', 'id', 'CASCADE' );
        $this->addForeignKey( 'fk-pricies-adverts', '{{%pricies}}', 'ad_id', '{{%adverts}}', 'id', 'CASCADE' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk-pricies-adverts', '{{%pricies}}' );
        $this->dropForeignKey( 'fk-responses-adverts', '{{%responses}}' );
        $this->dropColumn( '{{%adverts}}', 'response_count' );
        $this->dropTable( '{{%responses}}' );
    }
}
