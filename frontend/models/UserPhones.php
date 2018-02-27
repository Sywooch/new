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
            [ [ 'user_id', 'ad_id', 'sort' ], 'integer' ],
            [ [ 'phone' ], 'string', 'min' => 6, 'max' => 20 ],
            [ [ 'ad_id', 'phone', 'sort' ], 'required' ],
            ['phone', 'match', 'pattern' => '/^\s*[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?\s*$/', 'message' => 'Только цифры' ],
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
            'phone'   => 'Телефон',
            'sort'    => 'Sort',
        ];
    }
}
