<?php

use yii\db\Migration;

/**
 * Handles the creation of table `period`.
 */
class m171112_174213_create_period_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('period', [
            'id' => $this->primaryKey(),
            'period' => $this->integer(2)->unique(),
            'sort' => $this->integer(2)->unique(),
            'description' => $this->string(25),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('period');
    }
}
