<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m171028_153846_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable( '{{%category}}', [
            'id'            => $this->primaryKey(),
            'old_id'        => $this->integer( 2 )->notNull()->unique(),
            'category_name' => $this->string( 50 )->notNull()->unique(),
            'sort'          => $this->integer( 2 )->notNull()->unique(),
            'class_name'    => $this->string(),
            'icon'          => $this->string(),
        ], $tableOptions );

        Yii::$app->db->createCommand()->batchInsert( '{{%category}}', [
            'old_id',
            'category_name',
            'sort'
        ], [
            [ 1, 'Недвижимость', 1 ],
            [ 2, 'Транспорт', 2 ],
            [ 22, 'Хозяйство, быт', 3 ],
            [ 31, 'Хобби и отдых', 9 ],
            [ 38, 'Электроника', 5 ],
            [ 47, 'Услуги', 8 ],
            [ 50, 'Работа', 7 ],
            [ 51, 'Обращения', 12 ],
            [ 55, 'Строительство', 4 ],
            [ 56, 'Отдам даром', 11 ],
            [ 57, 'Всё для дачи', 10 ],
            [ 58, 'Оборудование', 6 ]
        ] )->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable( '{{%category}}' );
    }
}
