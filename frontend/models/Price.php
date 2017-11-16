<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $price_old
 * @property integer $currency
 * @property string $negotiable
 */
class Price extends \yii\db\ActiveRecord
{
    public $currency = 1;
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
            [['price', 'price_old', 'currency'], 'integer'],
            [['negotiable'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price' => 'Цена',
            'price_old' => 'Price Old',
            'currency' => 'Currency',
            'negotiable' => 'Negotiable',
        ];
    }
}
