<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $country_name
 *
 * @property Adverts $id0
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'country_name'], 'required'],
            [['old_id'], 'integer'],
            [['country_name'], 'string', 'max' => 50],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Adverts::className(), 'targetAttribute' => ['id' => 'city']],
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
            'country_name' => 'Country Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Adverts::className(), ['city' => 'id']);
    }
}
