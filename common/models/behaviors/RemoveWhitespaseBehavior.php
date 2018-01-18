<?php
/**
 * File: RemoveWhitespaseBehavior.php
 * Email: becksonq@gmail.com
 * Date: 17.01.2018
 * Time: 18:39
 */

namespace common\models\behaviors;


use yii\behaviors\AttributeBehavior;

class RemoveWhitespaseBehavior extends AttributeBehavior
{
    public $field;

    public function getValue( $event )
    {
        return str_replace( ' ', '', $this->owner->attributes[$this->field] );
    }
}