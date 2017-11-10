<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property integer $id
 * @property integer $old_id
 * @property integer $old_cat_id
 * @property integer $cat_id
 * @property string $subcat_name
 * @property integer $menu_order
 *
 * @property Category $cat
 * @property Adverts $id0
 * @property Category $oldCat
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
            [['old_id', 'old_cat_id', 'cat_id', 'subcat_name', 'menu_order'], 'required'],
            [['old_id', 'old_cat_id', 'cat_id', 'menu_order'], 'integer'],
            [['subcat_name'], 'string', 'max' => 50],
            [['old_id'], 'unique'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Adverts::className(), 'targetAttribute' => ['id' => 'subcat_id']],
            [['old_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['old_cat_id' => 'old_id']],
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
            'old_cat_id' => 'Old Cat ID',
            'cat_id' => 'Cat ID',
            'subcat_name' => 'Subcat Name',
            'menu_order' => 'Menu Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Adverts::className(), ['subcat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldCat()
    {
        return $this->hasOne(Category::className(), ['old_id' => 'old_cat_id']);
    }
}
