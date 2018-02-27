<?php

use yii\db\Migration;

/**
 * Handles adding has_images to table `adverts`.
 */
class m180114_141401_add_has_images_column_to_adverts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn( '{{%adverts}}', 'has_images', $this->boolean()->defaultValue( 0 ) );

//        $this->createIndex( '{{%idx-adverts-has_images}}', '{{%adverts}}', 'has_images' );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn( '{{%adverts}}', 'has_images' );
    }
}
