<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "adverts".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $sid
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property integer $type
 * @property string $header
 * @property string $comment
 * @property integer $city
 * @property integer $price
 * @property integer $period
 * @property integer $active
 * @property integer $selected
 * @property integer $special
 * @property integer $images
 * @property integer $ip
 * @property integer $created_at
 * @property integer $updated_at
 */
class Adverts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adverts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'sid', 'cat_id', 'subcat_id', 'type', 'header', 'city', 'ip', 'created_at', 'updated_at'], 'required'],
            [['old_id', 'cat_id', 'subcat_id', 'type', 'city', 'price', 'period', 'active', 'selected', 'special', 'images', 'ip', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
            [['sid'], 'string', 'max' => 32],
            [['header'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_id' => 'Old ID',
            'sid' => 'Sid',
            'cat_id' => 'Cat ID',
            'subcat_id' => 'Subcat ID',
            'type' => 'Type',
            'header' => 'Header',
            'comment' => 'Comment',
            'city' => 'City',
            'price' => 'Price',
            'period' => 'Period',
            'active' => 'Active',
            'selected' => 'Selected',
            'special' => 'Special',
            'images' => 'Images',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
