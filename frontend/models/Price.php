<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "price".
 *
 * @property integer $id
 * @property integer $price
 * @property integer $price_old
 * @property string $currency
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
            [['price', 'price_old', 'negotiable'], 'integer', 'min' => 0],
            [['currency'], 'string', 'max' => 12],
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
            'price_old' => 'Старая цена',
            'currency' => 'Currency',
            'negotiable' => 'Торг уместен',
        ];
    }
}
