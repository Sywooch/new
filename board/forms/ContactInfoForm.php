<?php
/**
 * File: ContactInfoForm.php
 * Email: becksonq@gmail.com
 * Date: 13.11.2017
 * Time: 21:14
 *
 * Контактная форма при подаче объявления во фронтенде
 */

namespace board\forms;


use yii\base\Model;

class ContactInfoForm extends Model
{
    public $username;
    public $useremail;
    public $userphone;

    public function __construct( $advert = null, $config = [] )
    {
        parent::__construct( $config );
    }

    public function rules()
    {
        return [
            [ [ 'username', 'useremail', 'userphone', ], 'required' ],
            [ [ 'username', 'useremail' ], 'string', 'max' => 255 ],
//            [ [ 'username', 'useremail', ], 'unique'],
            [ [ 'userphone', ], 'integer', 'min' => 0 ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя',
            'useremail' => 'Email',
            'userphone' => 'Телефон',
        ];
    }
}