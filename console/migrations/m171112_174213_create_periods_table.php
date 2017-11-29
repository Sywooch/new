<?php

use yii\db\Migration;

/**
 * Handles the creation of table `period`.
 */
class m171112_174213_create_periods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable( '{{%periods}}', [
            'id'          => $this->primaryKey(),
            'period'      => $this->integer( 2 )->unique(),
            'sort'        => $this->integer( 2 )->unique(),
            'description' => $this->string( 25 ),
        ] );

        Yii::$app->db->createCommand()->batchInsert( '{{%periods}}', [
            'period',
            'sort',
            'description',
        ], [
            [ 7, 1, '1 неделя' ],
            [ 14, 2, '2 недели' ],
            [ 21, 3, '3 недели' ],
            [ 28, 4, 'месяц' ],
            [ 56, 5, '2 месяца' ]
        ] )->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%periods}}' );
    }
}
