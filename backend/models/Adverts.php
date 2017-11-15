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
 * @property string $description
 * @property integer $city
 * @property integer $period
 * @property integer $active
 * @property integer $selected_old
 * @property integer $special_old
 * @property integer $images_old
 * @property integer $ip
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Country $city0
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
            [['old_id', 'cat_id', 'subcat_id', 'type', 'city', 'period', 'active', 'selected_old', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at'], 'integer'],
            [['sid', 'cat_id', 'subcat_id', 'type', 'header', 'city', 'ip', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['sid'], 'string', 'max' => 32],
            [['header'], 'string', 'max' => 255],
            [['sid'], 'unique'],
            [['old_id'], 'unique'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['city' => 'id']],
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
            'description' => 'Description',
            'city' => 'City',
            'period' => 'Period',
            'active' => 'Active',
            'selected_old' => 'Selected Old',
            'special_old' => 'Special Old',
            'images_old' => 'Images Old',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(Country::className(), ['id' => 'city']);
    }
}
