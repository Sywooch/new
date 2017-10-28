<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $category_name
 * @property integer $menu_order
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'category_name', 'menu_order'], 'required'],
            [['old_id', 'menu_order'], 'integer'],
            [['category_name'], 'string', 'max' => 50],
            [['old_id'], 'unique'],
            [['category_name'], 'unique'],
            [['menu_order'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_id' => 'Old ID',
            'category_name' => 'Category Name',
            'menu_order' => 'Menu Order',
        ];
    }
}
