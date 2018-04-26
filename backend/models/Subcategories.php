<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategories".
 *
 * @property integer $id
 * @property integer $old_id
 * @property integer $old_cat_id
 * @property integer $cat_id
 * @property string $subcat_name
 * @property integer $menu_order
 *
 * @property Categories $cat
 * @property Categories $oldCat
 */
class Subcategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'old_cat_id', 'cat_id', 'subcat_name', 'sort'], 'required'],
            [['old_id', 'old_cat_id', 'cat_id', 'sort'], 'integer'],
            [['subcat_name'], 'string', 'max' => 50],
            [['old_id'], 'unique'],
            [
                [ 'cat_id' ],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Categories::className(),
                'targetAttribute' => [ 'cat_id' => 'id' ]
            ],
            [
                [ 'old_cat_id' ],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Categories::className(),
                'targetAttribute' => [ 'old_cat_id' => 'old_id' ]
            ],
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
            'sort' => 'Menu Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne( Categories::className(), [ 'id' => 'cat_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOldCat()
    {
        return $this->hasOne( Categories::className(), [ 'old_id' => 'old_cat_id' ] );
    }
}
