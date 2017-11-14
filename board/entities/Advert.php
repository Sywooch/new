<?php
/**
 * File: Advert.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 12:25
 */

namespace board\entities;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
class Advert
{
    public static function tableName()
    {
        return '{{%advert}}';
    }

    public function create(){

    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['categoryAssignments', 'tagAssignments', 'relatedAssignments', 'modifications', 'values', 'photos', 'reviews'],
            ],
        ];
    }
}