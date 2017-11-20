<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%user_phones}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $ad_id
 * @property integer $phone
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
            [ [ 'user_id', 'ad_id', 'sort' ], 'integer' ],
            [ [ 'phone', ], 'integer' ],
//            [ [ 'phone', ], 'integer', 'min' => 5, 'max' => '20' ],
            [ [ 'phone' ], 'required' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'user_id' => 'User ID',
            'ad_id'   => 'Ad ID',
            'phone'   => 'Phone',
            'sort'    => 'Sort',
        ];
    }
}
