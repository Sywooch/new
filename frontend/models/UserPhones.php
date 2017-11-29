<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user_phones}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property string $phone
 * @property integer $sort
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
            [['user_id', 'ad_id', 'sort'], 'integer'],
            [['phone'], 'string', 'min'=>6, 'max' => 20],
//            ['phone', 'match', 'pattern' => '/^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Неправильно написан номер' ]
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
            'phone' => 'Phone',
            'sort' => 'Sort',
        ];
    }
}
