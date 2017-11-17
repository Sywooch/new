<?php

namespace frontend\models;

use Yii;
use dektrium\user\models\User;

/**
 * This is the model class for table "{{%user_phones}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property integer $phone
 * @property integer $sort
 *
 * @property User $user
 */
class UserPhones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_phones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ad_id', 'phone', 'sort'], 'integer'],
            [['phone'], 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'ad_id' => 'Ad ID',
            'phone' => 'Телефон',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
