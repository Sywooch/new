<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $price_old
 * @property integer $currancy
 * @property integer $negotiable
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'price_old', 'currancy', 'negotiable'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Price',
            'price_old' => 'Price Old',
            'currancy' => 'Currancy',
            'negotiable' => 'Negotiable',
        ];
    }
}
