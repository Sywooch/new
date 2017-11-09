<?php

use yii\db\Migration;

/**
 * Handles the creation of table `svc_type`.
 */
class m171109_195424_create_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%type}}', [
            'id'       => $this->primaryKey(),
            'old_type' => $this->integer( 2 )->unique(),
            'name'     => $this->string( 15 )->notNull()->unique(),
            'sort'     => $this->integer()->notNull()->unique(),
        ], $tableOptions );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%type}}' );
    }
}
