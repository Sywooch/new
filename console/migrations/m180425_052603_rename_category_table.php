<?php

use yii\db\Migration;

/**
 * Class m180425_080223_rename_category_table
 */
class m180425_052603_rename_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable( 'category', 'categories' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable( 'categories', 'category' );
    }
}
