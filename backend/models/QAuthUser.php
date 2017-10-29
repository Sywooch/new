<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "dob29r70_qplb.QAuthUser".
 *
 * @property integer $QAuthUserID
 * @property string $QAuthUserEmail
 * @property string $QAuthUserUserName
 * @property string $QAuthUserPassHash
 * @property string $QAuthUserActivationHash
 * @property integer $QAuthUserGroupID
 * @property integer $QAuthUserStatus
 * @property integer $QAuthUserCreated
 * @property integer $QAuthUserLastAuthDate
 * @property integer $QAuthUserLastIP
 * @property string $QAuthUserFullName
 * @property string $QAuthUserCompany
 * @property string $QAuthUserWebsite
 * @property string $QAuthUserPhone
 * @property string $QAuthUserCity
 * @property string $QAuthUserAddress
 * @property string $QAuthUserZip
 * @property string $QAuthUserICQ
 * @property string $QAuthUserSkype
 * @property string $QAuthUserTwitter
 * @property string $QAuthUserLJ
 * @property integer $QAuthUserDOB
 * @property integer $QAuthUserGender
 * @property integer $QAuthUserRating
 * @property string $QAuthUserAbout
 * @property string $QAuthUserExtra
 * @property integer $rights
 */
class QAuthUser extends \common\models\User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dob29r70_qplb.QAuthUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['QAuthUserGroupID', 'QAuthUserStatus', 'QAuthUserCreated', 'QAuthUserLastAuthDate', 'QAuthUserLastIP', 'QAuthUserDOB', 'QAuthUserGender', 'QAuthUserRating', 'rights'], 'integer'],
            [['QAuthUserAbout', 'QAuthUserExtra'], 'string'],
            [['rights'], 'required'],
            [['QAuthUserEmail', 'QAuthUserUserName', 'QAuthUserFullName', 'QAuthUserCompany', 'QAuthUserPhone', 'QAuthUserICQ', 'QAuthUserSkype', 'QAuthUserTwitter', 'QAuthUserLJ'], 'string', 'max' => 80],
            [['QAuthUserPassHash', 'QAuthUserActivationHash'], 'string', 'max' => 32],
            [['QAuthUserWebsite', 'QAuthUserCity'], 'string', 'max' => 120],
            [['QAuthUserAddress'], 'string', 'max' => 200],
            [['QAuthUserZip'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'QAuthUserID' => 'Qauth User ID',
            'QAuthUserEmail' => 'Qauth User Email',
            'QAuthUserUserName' => 'Qauth User User Name',
            'QAuthUserPassHash' => 'Qauth User Pass Hash',
            'QAuthUserActivationHash' => 'Qauth User Activation Hash',
            'QAuthUserGroupID' => 'Qauth User Group ID',
            'QAuthUserStatus' => 'Qauth User Status',
            'QAuthUserCreated' => 'Qauth User Created',
            'QAuthUserLastAuthDate' => 'Qauth User Last Auth Date',
            'QAuthUserLastIP' => 'Qauth User Last Ip',
            'QAuthUserFullName' => 'Qauth User Full Name',
            'QAuthUserCompany' => 'Qauth User Company',
            'QAuthUserWebsite' => 'Qauth User Website',
            'QAuthUserPhone' => 'Qauth User Phone',
            'QAuthUserCity' => 'Qauth User City',
            'QAuthUserAddress' => 'Qauth User Address',
            'QAuthUserZip' => 'Qauth User Zip',
            'QAuthUserICQ' => 'Qauth User Icq',
            'QAuthUserSkype' => 'Qauth User Skype',
            'QAuthUserTwitter' => 'Qauth User Twitter',
            'QAuthUserLJ' => 'Qauth User Lj',
            'QAuthUserDOB' => 'Qauth User Dob',
            'QAuthUserGender' => 'Qauth User Gender',
            'QAuthUserRating' => 'Qauth User Rating',
            'QAuthUserAbout' => 'Qauth User About',
            'QAuthUserExtra' => 'Qauth User Extra',
            'rights' => 'Rights',
        ];
    }
}
