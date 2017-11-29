<?php

use yii\db\Migration;

/**
 * Handles the creation of table `svc_type`.
 */
class m171109_195424_create_types_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%types}}', [
            'id'       => $this->primaryKey(),
            'old_type' => $this->integer( 2 )->unique(),
            'name'     => $this->string( 15 )->notNull()->unique(),
            'sort'     => $this->integer()->notNull()->unique(),
        ], $tableOptions );

        Yii::$app->db->createCommand()->batchInsert( '{{%types}}', [
            'old_type',
            'name',
            'sort'
        ], [
            [ 1, 'Продам', 1 ],
            [ 2, 'Сдам', 2 ],
            [ 3, 'Сниму', 3 ],
            [ 4, 'Предлагаю', 4 ],
            [ 5, 'Воспользуюсь', 5 ],
            [ 6, 'Ищу', 6 ],
            [ 7, 'Отдам', 7 ],
            [ 8, 'Приму в дар', 8 ],
            [ 9, 'Обменяю', 9 ],
        ] )->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%types}}' );
    }
}
