<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $category_name
 * @property integer $sort
 * @property string $class_name
 * @property string $icon
 *
 * @property Adverts[] $adverts
 * @property Subcategories[] $subcategories
 * @property Subcategories[] $subcategories0
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'category_name', 'sort'], 'required'],
            [['old_id', 'sort'], 'integer'],
            [['category_name'], 'string', 'max' => 50],
            [['class_name', 'icon'], 'string', 'max' => 255],
            [['old_id'], 'unique'],
            [['category_name'], 'unique'],
            [['sort'], 'unique'],
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
            'sort' => 'Sort',
            'class_name' => 'Class Name',
            'icon' => 'Icon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Adverts::className(), ['cat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories()
    {
        return $this->hasMany( Subcategories::className(), [ 'cat_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories0()
    {
        return $this->hasMany( Subcategories::className(), [ 'old_cat_id' => 'old_id' ] );
    }
}
