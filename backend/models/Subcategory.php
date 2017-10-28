<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property integer $id
 * @property integer $old_id
 * @property integer $cut_id
 * @property string $subcat_name
 * @property integer $menu_order
 *
 * @property Category $cut
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'cut_id', 'subcat_name', 'menu_order'], 'required'],
            [['old_id', 'cut_id', 'menu_order'], 'integer'],
            [['subcat_name'], 'string', 'max' => 50],
            [['old_id'], 'unique'],
            [['cut_id'], 'unique'],
            [['subcat_name'], 'unique'],
            [['menu_order'], 'unique'],
            [['cut_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cut_id' => 'id']],
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
            'cut_id' => 'Cut ID',
            'subcat_name' => 'Subcat Name',
            'menu_order' => 'Menu Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCut()
    {
        return $this->hasOne(Category::className(), ['id' => 'cut_id']);
    }
}
