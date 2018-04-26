<?php

use yii\db\Migration;

/**
 * Class m180425_121144_rename_subcategory_table
 */
class m180425_053602_rename_subcategory_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable( 'subcategory', 'subcategories' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable( 'subcategories', 'subcategory' );
    }
}
