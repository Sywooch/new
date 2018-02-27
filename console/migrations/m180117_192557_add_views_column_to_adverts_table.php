<?php

use yii\db\Migration;

/**
 * Handles adding views to table `adverts`.
 */
class m180117_192557_add_views_column_to_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn( '{{%adverts}}', 'views', $this->integer()->defaultValue( 1 ) );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%adverts}}', 'views' );
    }
}
