<?php
/**
 * File: PriceForm.php
 * Email: becksonq@gmail.com
 * Date: 12.11.2017
 * Time: 22:26
 */

namespace board\forms;


use yii\base\Model;

class PriceForm extends Model
{
    public $price;
    public $price_old;
    public $currency;
    public $negotiable;

    public function __construct( $advert = null, $config = [])
    {
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['price', 'price_old'], 'integer', 'min' => 0],
        ];
    }

    public function attributeLabels()
    {
        return [
            'price' => 'Цена',
        ];
    }

    public function negotiableCheck(){

    }

}