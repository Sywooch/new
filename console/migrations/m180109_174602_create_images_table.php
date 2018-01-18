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
            'id'         => $this->primaryKey(),
            'ad_id'      => $this->integer()->defaultValue( null ),
            'sid'        => $this->string( 32 )->notNull(),
            'marker'     => $this->integer()->defaultValue( null ),
            'main_image' => $this->boolean()->defaultValue( 0 ),
            'filename'   => $this->string( 255 )->notNull()->unique(),
            'size'       => $this->integer()->defaultValue( null ),
            'path'       => $this->string( 255 )->notNull()
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
