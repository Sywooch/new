<?php

namespace backend\models;

use common\models\behaviors\RemoveWhitespaseBehavior;
use board\entities\Adverts;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%price}}".
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $price_value
 * @property integer $price_old
 * @property integer $currency_id
 * @property string $negotiable
 *
 * @property Currencies $currency
 */
class Pricies extends ActiveRecord
{
    const PRICE_CURRENCY_SEPARATOR = '&nbsp;';
    const EMPTY_PRICE_VALUE = '...';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pricies}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'ad_id', 'old_id', 'price_old', 'currency_id', 'price_value' ], 'integer' ],
            [ 'price_value', 'match', 'pattern' => '/^[0-9\s]+$/', 'message' => 'Только цифры' ],// Все кроме цифр
            [ ['negotiable'], 'boolean'],
            [ ['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => [ 'currency_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class'      => RemoveWhitespaseBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'price_value',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'price_value',
                ],
                'field'      => 'price_value',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'ad_id'       => 'Ad ID',
            'old_id'      => 'Old_ID',
            'price_value' => 'Цена',
            'price_old'   => 'Price Old',
            'currency_id' => 'Currency ID',
            'negotiable'  => 'Торг уместен',
        ];
    }

//    public function beforeSave( $insert )
//    {
//        $this->price_value = str_replace( ' ', '', $this->price_value );
//        return true;
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne( Currencies::class, [ 'id' => 'currency_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvert()
    {
        return $this->hasOne( Adverts::class, [ 'id' => 'ad_id' ] );
    }

    /**
     * TODO: проверить нужен ли этот метод
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public static function findModel( $id )
    {
        if ( ( $model = static::findOne( [ 'ad_id' => $id ] ) ) !== null ) {
            return $model;
        }
        throw new NotFoundHttpException( 'The requested page does not exist.' );
    }
}
