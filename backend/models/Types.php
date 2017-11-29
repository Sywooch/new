<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "types".
 *
 * @property integer $id
 * @property integer $old_type
 * @property string $name
 * @property integer $sort
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_type', 'sort'], 'integer'],
            [['name', 'sort'], 'required'],
            [['name'], 'string', 'max' => 15],
            [['name'], 'unique'],
            [['sort'], 'unique'],
            [['old_type'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_type' => 'Old Type',
            'name' => 'Name',
            'sort' => 'Sort',
        ];
    }

    public function getAdverts()
    {
        return $this->hasMany(Adverts::className(), ['type' => 'id']);
    }
}
