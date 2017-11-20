<?php

use yii\db\Migration;

/**
 * Handles adding draft to table `adverts`.
 */
class m171117_154320_add_draft_column_to_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn( 'adverts', 'draft', $this->boolean() );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('adverts', 'draft');
    }
}
