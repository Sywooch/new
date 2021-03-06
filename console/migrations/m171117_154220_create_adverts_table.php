<?php

use yii\db\Migration;

/**
 * Handles the creation of table `adverts`.
 */
class m171117_154220_create_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%adverts}}', [
            'id'           => $this->primaryKey(),
            'old_id'       => $this->integer()->unique()->defaultValue( null ),
            'sid'          => $this->string( 32 )->notNull(),
            'cat_id'       => $this->integer( 3 )->notNull(),
            'subcat_id'    => $this->integer( 3 )->notNull(),
            'type'         => $this->integer( 2 )->notNull(),
            'header'       => $this->string( 255 )->notNull(),
            'description'  => $this->text(),
            'country'      => $this->integer( 3 )->notNull(),
            'period'       => $this->integer( 2 )->notNull(),
            'author'       => $this->string(),
            'email'        => $this->string(),
            'active'       => $this->boolean()->defaultValue( 1 ),
            'selected'     => $this->boolean()->defaultValue( 0 ),
            'selected_old' => $this->boolean()->defaultValue( 0 ),
            'special'      => $this->boolean()->defaultValue( 0 ),
            'special_old'  => $this->boolean()->defaultValue( 0 ),
            'images_old'   => $this->boolean()->defaultValue( 0 ),
            'ip'           => $this->integer( 15 )->notNull(),
            'created_at'   => $this->integer()->unsigned()->notNull(),
            'updated_at'   => $this->integer()->unsigned()->notNull(),
            'draft'        => $this->boolean()->defaultValue( 1 ),
        ], $tableOptions );

        $this->addForeignKey( 'fk-countries_id', '{{%adverts}}', 'country', '{{%countries}}', 'id' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%adverts}}' );
    }
}
