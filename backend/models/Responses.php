<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%responses}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 *
 * @property Adverts[] $adverts
 */
class Responses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%responses}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'message' ], 'string' ],
            [ [ 'name', 'email' ], 'string', 'max' => 120 ],
            [ [ 'phone' ], 'string', 'max' => 20 ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'name'    => 'Name',
            'email'   => 'Email',
            'phone'   => 'Phone',
            'message' => 'Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne( Adverts::className(), [ 'response_id' => 'id' ] );
    }
}
