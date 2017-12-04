<?php

namespace backend\models;

use Yii;
use backend\models\Pricies;

/**
 * This is the model class for table "{{%currency}}".
 *
 * @property integer $id
 * @property string $short_name
 * @property string $name
 * @property integer $value
 *
 * @property Pricies[] $prices
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%currencies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'short_name', 'name' ], 'required' ],
            [ [ 'value' ], 'integer' ],
            [ [ 'short_name', 'name' ], 'string', 'max' => 255 ],
            [ [ 'short_name' ], 'unique' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'short_name' => 'Short Name',
            'name'       => 'Name',
            'value'      => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPricies()
    {
        return $this->hasMany( Pricies::className(), [ 'currency_id' => 'id' ] );
    }
}
