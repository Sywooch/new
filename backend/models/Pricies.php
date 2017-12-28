<?php

namespace backend\models;

use Yii;
use backend\models\Currencies;
use board\entities\Adverts;

/**
 * This is the model class for table "{{%price}}".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $price
 * @property integer $price_old
 * @property integer $currency_id
 * @property string $negotiable
 *
 * @property Currencies $currency
 */
class Pricies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pricies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ ['ad_id', 'old_id', 'price', 'price_old', 'currency_id' ], 'integer' ],
            [ ['price'], 'integer', 'max' => 50000000 ],
            [ 'price', 'default', 'value' => 0 ],
            [ ['negotiable'], 'boolean'],
            [ ['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => [ 'currency_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ad_id' => 'Ad ID',
            'old_id' => 'Old_ID',
            'price' => 'Цена',
            'price_old' => 'Price Old',
            'currency_id' => 'Currency ID',
            'negotiable' => 'Negotiable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencies()
    {
        return $this->hasOne(Currencies::className(), [ 'id' => 'currency_id']);
    }

    public function getAdverts()
    {
        return $this->hasMany(Adverts::className(), ['id' => 'ad_id']);
    }
}
