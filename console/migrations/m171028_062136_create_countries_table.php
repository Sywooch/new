<?php

use yii\db\Migration;

/**
 * Handles the creation of table `country`.
 */
class m171028_062136_create_countries_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%countries}}', [
            'id'           => $this->primaryKey(),
            'old_id'       => $this->integer( 3 )->notNull(),
            'country_name' => $this->string( 50 )->notNull(),
            'sort'         => $this->integer( 3 )->notNull(),
        ], $tableOptions );

        Yii::$app->db->createCommand()->batchInsert( '{{%countries}}', [
            'old_id',
            'country_name',
            'sort',
        ], [
            [ 7, 'Архангельск', 1 ],
            [ 395, 'Северодвинск', 2 ],
            [ 397, 'Новодвинск', 3 ],
            [ 398, 'Котлас', 4 ],
            [ 399, 'Вельск', 5 ],
            [ 402, 'Каргополь', 6 ],
            [ 403, 'Коноша', 7 ],
            [ 404, 'Коряжма', 8 ],
            [ 405, 'Мезень', 9 ],
            [ 406, 'Мирный', 10 ],
            [ 407, 'Няндома', 11 ],
            [ 409, 'Онега', 12 ],
            [ 410, 'Пинега', 13 ],
            [ 411, 'Плесецк', 14 ],
            [ 414, 'Шенкурск', 15 ],
            [ 415, 'Другой', 16 ],
        ] )->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%countries}}' );
    }
}
