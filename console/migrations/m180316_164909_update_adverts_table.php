<?php

use yii\db\Migration;

/**
 * Class m180316_164909_update_adverts_table
 */
class m180316_164909_update_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->renameColumn( 'adverts', 'country', 'country_id' );
        $this->renameColumn( 'adverts', 'type', 'type_id' );
        $this->renameColumn( 'adverts', 'period', 'period_id' );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->renameColumn( 'adverts', 'country_id', 'country' );
        $this->renameColumn( 'adverts', 'type_id', 'type' );
        $this->renameColumn( 'adverts', 'period_id', 'period' );
    }
}
