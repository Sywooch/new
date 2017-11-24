<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%adverts}}".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $sid
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property integer $type
 * @property string $header
 * @property string $description
 * @property integer $countries
 * @property integer $periods
 * @property string $author
 * @property string $email
 * @property integer $active
 * @property integer $selected
 * @property integer $selected_old
 * @property integer $special
 * @property integer $special_old
 * @property integer $images_old
 * @property integer $ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $draft
 *
 * @property Category $cat
 * @property Country $countries0
 * @property Period $periods0
 * @property Subcategory $subcat
 * @property Type $type0
 */
class Adverts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%adverts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old_id', 'cat_id', 'subcat_id', 'type', 'countries', 'periods', 'active', 'selected', 'selected_old', 'special', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at', 'draft'], 'integer'],
            [['sid', 'cat_id', 'subcat_id', 'type', 'header', 'countries', 'ip', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['sid'], 'string', 'max' => 32],
            [['header', 'author', 'email'], 'string', 'max' => 255],
            [['sid'], 'unique'],
            [['old_id'], 'unique'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['countries'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countries' => 'id']],
            [['periods'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['periods' => 'id']],
            [['subcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcat_id' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type' => 'id']],
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
            'countries' => 'Countries',
            'periods' => 'Periods',
            'author' => 'Author',
            'email' => 'Email',
            'active' => 'Active',
            'selected' => 'Selected',
            'selected_old' => 'Selected Old',
            'special' => 'Special',
            'special_old' => 'Special Old',
            'images_old' => 'Images Old',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'draft' => 'Draft',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries0()
    {
        return $this->hasOne(Country::className(), ['id' => 'countries']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriods0()
    {
        return $this->hasOne(Period::className(), ['id' => 'periods']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcat()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(Type::className(), ['id' => 'type']);
    }
}
