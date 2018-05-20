<?php

use yii\db\Migration;

/**
 * Class m180429_104924_update_images_table
 */
class m180429_104924_update_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn( '{{%images}}', 'marker' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn( '{{%images}}', 'marker', $this->integer()->defaultValue( null ) );
    }
}
