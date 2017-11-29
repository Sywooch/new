<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Advert".
 *
 * @property integer $AdvertID
 * @property string $AdvertsID
 * @property integer $AdvertFolder
 * @property integer $AdvertType
 * @property string $AdvertHeader
 * @property string $AdvertComment
 * @property integer $AdvertCity
 * @property integer $AdvertPrice
 * @property integer $AdvertCurrency
 * @property integer $AdvertPeriod
 * @property integer $AdvertTime
 * @property integer $AdvertApproved
 * @property integer $AdvertActive
 * @property integer $AdvertPlaced
 * @property integer $AdvertSelected
 * @property integer $AdvertSelectedStart
 * @property integer $AdvertSelectedDur
 * @property integer $AdvertSpecial
 * @property integer $AdvertSpecialStart
 * @property integer $AdvertSpecialDur
 * @property integer $AdvertImage1
 * @property integer $AdvertImage2
 * @property integer $AdvertImage3
 * @property integer $AdvertImage4
 * @property integer $AdvertImage5
 * @property integer $AdvertImage6
 * @property integer $AdvertUserID
 * @property string $AdvertUserName
 * @property string $AdvertUserEmail
 * @property string $AdvertUserPhone
 * @property string $AdvertUserICQ
 * @property string $AdvertUrl
 * @property integer $AdvertRate
 * @property integer $AdvertViewDay
 * @property integer $AdvertViewWeek
 * @property integer $AdvertViewMonth
 * @property integer $AdvertIPAdress
 * @property integer $AdvertIPProxyAdress
 * @property integer $AdvertSendViaEmail
 * @property string $AdvertCustomValues
 * @property string $AdvertPass
 * @property string $AdvertImgDescription
 * @property string $AdvertAdvHash
 * @property integer $AdvertTimeOriginated
 * @property integer $AdvertSold
 * @property integer $AdvertResponses
 * @property string $AdvertUserPhone2
 * @property string $AdvertAddress
 * @property integer $AdvertUp
 * @property integer $AdvertImg
 * @property string $AdvertEmailReal
 * @property integer $exist_adv_id
 */
class Advert extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Advert';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_qpl');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AdvertFolder', 'AdvertType', 'AdvertCity', 'AdvertPrice', 'AdvertCurrency', 'AdvertPeriod', 'AdvertTime', 'AdvertApproved', 'AdvertActive', 'AdvertPlaced', 'AdvertSelected', 'AdvertSelectedStart', 'AdvertSelectedDur', 'AdvertSpecial', 'AdvertSpecialStart', 'AdvertSpecialDur', 'AdvertImage1', 'AdvertImage2', 'AdvertImage3', 'AdvertImage4', 'AdvertImage5', 'AdvertImage6', 'AdvertUserID', 'AdvertRate', 'AdvertViewDay', 'AdvertViewWeek', 'AdvertViewMonth', 'AdvertIPAdress', 'AdvertIPProxyAdress', 'AdvertSendViaEmail', 'AdvertTimeOriginated', 'AdvertSold', 'AdvertResponses', 'AdvertUp', 'AdvertImg', 'exist_adv_id'], 'integer'],
            [['AdvertHeader', 'AdvertComment', 'AdvertCustomValues', 'AdvertImgDescription', 'AdvertAdvHash', 'AdvertAddress'], 'string'],
            [['AdvertUp', 'AdvertImg'], 'required'],
            [['AdvertsID', 'AdvertPass'], 'string', 'max' => 32],
            [['AdvertUserName', 'AdvertUserEmail', 'AdvertUrl', 'AdvertEmailReal'], 'string', 'max' => 100],
            [['AdvertUserPhone', 'AdvertUserICQ', 'AdvertUserPhone2'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AdvertID' => 'Advert ID',
            'AdvertsID' => 'Adverts ID',
            'AdvertFolder' => 'Advert Folder',
            'AdvertType' => 'Advert Type',
            'AdvertHeader' => 'Advert Header',
            'AdvertComment' => 'Advert Comment',
            'AdvertCity' => 'Advert City',
            'AdvertPrice' => 'Advert Price',
            'AdvertCurrency' => 'Advert Currency',
            'AdvertPeriod' => 'Advert Period',
            'AdvertTime' => 'Advert Time',
            'AdvertApproved' => 'Advert Approved',
            'AdvertActive' => 'Advert Active',
            'AdvertPlaced' => 'Advert Placed',
            'AdvertSelected' => 'Advert Selected',
            'AdvertSelectedStart' => 'Advert Selected Start',
            'AdvertSelectedDur' => 'Advert Selected Dur',
            'AdvertSpecial' => 'Advert Special',
            'AdvertSpecialStart' => 'Advert Special Start',
            'AdvertSpecialDur' => 'Advert Special Dur',
            'AdvertImage1' => 'Advert Image1',
            'AdvertImage2' => 'Advert Image2',
            'AdvertImage3' => 'Advert Image3',
            'AdvertImage4' => 'Advert Image4',
            'AdvertImage5' => 'Advert Image5',
            'AdvertImage6' => 'Advert Image6',
            'AdvertUserID' => 'Advert User ID',
            'AdvertUserName' => 'Advert User Name',
            'AdvertUserEmail' => 'Advert User Email',
            'AdvertUserPhone' => 'Advert User Phone',
            'AdvertUserICQ' => 'Advert User Icq',
            'AdvertUrl' => 'Advert Url',
            'AdvertRate' => 'Advert Rate',
            'AdvertViewDay' => 'Advert View Day',
            'AdvertViewWeek' => 'Advert View Week',
            'AdvertViewMonth' => 'Advert View Month',
            'AdvertIPAdress' => 'Advert Ipadress',
            'AdvertIPProxyAdress' => 'Advert Ipproxy Adress',
            'AdvertSendViaEmail' => 'Advert Send Via Email',
            'AdvertCustomValues' => 'Advert Custom Values',
            'AdvertPass' => 'Advert Pass',
            'AdvertImgDescription' => 'Advert Img Description',
            'AdvertAdvHash' => 'Advert Adv Hash',
            'AdvertTimeOriginated' => 'Advert Time Originated',
            'AdvertSold' => 'Advert Sold',
            'AdvertResponses' => 'Advert Responses',
            'AdvertUserPhone2' => 'Advert User Phone2',
            'AdvertAddress' => 'Advert Address',
            'AdvertUp' => 'Advert Up',
            'AdvertImg' => 'Advert Img',
            'AdvertEmailReal' => 'Advert Email Real',
            'exist_adv_id' => 'Exist Adv ID',
        ];
    }
}
