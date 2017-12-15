<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%images}}".
 *
 * @property integer $id
 * @property string $ad_id
 * @property string $name
 * @property string $avatar
 * @property string $filename
 * @property string $image
 * @property string $path
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ad_id', 'name'], 'required'],
            [['ad_id', 'name', 'avatar', 'filename', 'image', 'path'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ad_id' => 'Ad ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
            'filename' => 'Filename',
            'image' => 'Image',
            'path' => 'Path',
        ];
    }
}
