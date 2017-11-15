<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 18:29
 * Email: becksonq@gmail.com
 */

namespace board\services;

use frontend\models\UserPhones;
use yii\helpers\ArrayHelper;

class UserInfo
{
    public static function getUserPhones( $id )
    {
        return UserPhones::find()->where( 'user_id' == $id )->orderBy( 'sort' )->asArray()->all();
    }
}