<?php

namespace frontend\models;

use Yii;
use board\entities\Adverts;

/**
 * This is the model class for table "{{%responses}}".
 *
 * @property int $id
 * @property int $ad_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 *
 * @property Adverts[] $adverts
 */
class Responses extends \yii\db\ActiveRecord
{
    public $verifyCode;

    const SCENARIO_RESP = 'resp';

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
            [ [ 'ad_id' ], 'integer' ],
            [ [ 'phone' ], 'string', 'max' => 20 ],
            [ [ 'email', 'message', 'ad_id' ], 'required' ],
            [ [ 'email' ], 'email' ],
            [ [ 'verifyCode' ], 'captcha' ],
            [ [ 'verifyCode' ], 'required' ],
            //            [ [ 'verifyCode' ], 'captcha', 'skipOnEmpty' => true, 'on' => self::SCENARIO_RESP ],
            //            [ ['verifyCode'], 'required', 'on' => Yii::$app->user->isGuest ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'ad_id'      => 'Ad ID',
            'name'       => 'Имя',
            'email'      => 'Email',
            'phone'      => 'Телефон',
            'message'    => 'Сообщение',
            'verifyCode' => 'Проверочный код',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne( Adverts::className(), [ 'id' => 'ad_id' ] );
    }
}
