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
            'name'    => $this->string( 120 ),
            'email'   => $this->string( 120 ),
            'phone'   => $this->string( 20 ),
            'message' => $this->text(),
        ], $tableOptions );

        $this->addColumn( '{{%adverts}}', 'response_id', $this->integer() );
        $this->addForeignKey( 'fk-adverts-responses', '{{%adverts}}', 'response_id', '{{%responses}}', 'id',
            'CASCADE' );
        $this->addForeignKey( 'fk-pricies-adverts', '{{%pricies}}', 'ad_id', '{{%adverts}}', 'id', 'CASCADE' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk-pricies-adverts', '{{%pricies}}' );
        $this->dropForeignKey( 'fk-adverts-responses', '{{%adverts}}' );
        $this->dropColumn( '{{%adverts}}', 'response_id' );
        $this->dropTable( '{{%responses}}' );
    }
}
