<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m171117_043336_create_currencies_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%currencies}}', [
            'id'         => $this->primaryKey(),
            'short_name' => $this->string()->unique()->notNull(),
            'name'       => $this->string()->notNull(),
            'value'      => $this->integer(),

        ], $tableOptions );

        Yii::$app->db->createCommand()->batchInsert( '{{%currencies}}', [
            'short_name',
            'name',
            'value',
        ], [
            [ 'руб', 'Рубль', 1 ],
            [ 'usd', 'Dollar', null ],
            [ 'euro', 'Euro', null ]
        ] )->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%currencies}}' );
    }
}
