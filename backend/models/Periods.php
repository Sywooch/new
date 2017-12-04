<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%period}}".
 *
 * @property integer $id
 * @property integer $period
 * @property integer $sort
 * @property string $description
 *
 * @property Adverts[] $adverts
 */
class Periods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%periods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['period', 'sort'], 'integer'],
            [['period', 'sort'], 'required'],
            [['description'], 'string', 'max' => 25],
            [['period'], 'unique'],
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
            'period' => 'Период',
            'sort' => 'Sort',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdverts()
    {
        return $this->hasMany(Adverts::className(), ['period' => 'id']);
    }
}
