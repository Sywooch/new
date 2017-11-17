<?php

namespace frontend\models;

use Yii;
use backend\models\Currency;

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
 * @property Currency $currency
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id', 'price', 'price_old', 'currency_id'], 'integer'],
            [['negotiable'], 'string', 'max' => 2],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
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
            'price' => 'Price',
            'price_old' => 'Price Old',
            'currency_id' => 'Currency ID',
            'negotiable' => 'Negotiable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}
