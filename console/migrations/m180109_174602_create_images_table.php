<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 */
class m180109_174602_create_images_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%images}}', [
            'id'       => $this->primaryKey(),
            'ad_id'    => $this->string(255)->notNull(),
            'name'     => $this->string(255)->notNull(),
            'image'    => $this->string(255)->notNull(),
            'filename' => $this->string( 255)->notNull()->unique(),
            'size'     => $this->integer( 255 )->defaultValue( null ),
            'path'     => $this->string( 255 )->notNull()
        ], $tableOptions );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%images}}' );
    }
}
