<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "type".
 *
 * @property integer $id
 * @property integer $old_type
 * @property string $name
 * @property integer $sort
 *
 * @property Adverts $id0
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type';
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
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Adverts::className(), 'targetAttribute' => ['id' => 'type']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Adverts::className(), ['type' => 'id']);
    }
}
