<?php
/**
 * File: AdvertCreateForm.php
 * Email: becksonq@gmail.com
 * Date: 11.11.2017
 * Time: 22:13
 */

namespace board\forms;

use yii;
use backend\models\Country;
use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Subcategory;
use backend\models\Type;
use backend\models\Period;
use common\models\User;
use frontend\models\Price;

class AdvertCreateForm extends CompositeForm
{
    public $cat_id;
    public $subcat_id;
    public $period;
    public $type;
    public $header;
    public $description;
    public $city;
    public $username;
    public $useremail;
    public $userphone;

    /*public function __construct( $cat_id, $subcat_id, $period, $type, $header, $description, $city, $config = [] )
    {
        $this->cat_id = $cat_id;
        $this->subcat_id = $subcat_id;
        $this->period = $period;
        $this->type = $type;
        $this->header = $header;
        $this->description = $description;
        $this->city = $city;
        $this->price = new PriceForm();
        $this->images = new ImageForm();
        $this->contactInfo = new ContactInfoForm();
        parent::__construct( $config );
    }*/

    public function __construct( $config = [] )
    {
        $this->priceForm = new Price();
        $this->imagesForm = new ImageForm();
//        $this->contactInfo = new ContactInfoForm();
        parent::__construct( $config );
    }

    public function rules()
    {
        return [
            [ [ 'cat_id', 'subcat_id', 'period', 'type', 'header', 'description', 'city', ], 'required' ],
            [ [ 'cat_id', 'subcat_id' ], 'integer' ],
            [ [ 'description' ], 'string', 'max' => 255 ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'cat_id'      => 'Раздел',
            'subcat_id'   => 'Подраздел',
            'period'      => 'Период',
            'type'        => 'Тип',
            'header'      => 'Заголовок',
            'description' => 'Описание',
//            'city'        => 'Город',
//            'price'       => 'Цена',
//            'images'      => 'Фотографии',
            'username'    => 'Имя',
            'useremail'   => 'Email',
            'userphone'   => 'Телефон'
        ];
    }

    /*public function getUserName()
    {
        if ( !Yii::$app->user->isGuest ) {
            $id = Yii::$app->user->id;
            return User::find()->select( 'username' )->where( 'id' == $id )->asArray()->one();
        }
        else {
            return 'Иванов Иван';
        }
    }

    public function getUserEmail()
    {
        if ( !Yii::$app->user->isGuest ) {
            $id = Yii::$app->user->id;
            return User::find()->select( 'email' )->where( 'id' == $id )->asArray()->one();
        }
        else {
            return 'someone@mail.ru';
        }
    }

    public function getUserPhone()
    {
        if ( !Yii::$app->user->isGuest ) {
            $id = Yii::$app->user->id;
            return UserInfo::getUserPhones( $id );
        }
        else {
            return '8 xxx xxx xx xx';
        }
    }*/

    public function categoryList()
    {
        return ArrayHelper::map( Category::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'category_name' );
    }

    public function subcategoryList()
    {
        return ArrayHelper::map( Subcategory::find()->orderBy( 'menu_order' )->asArray()->all(), 'id', 'subcat_name' );
    }

    public function typeList()
    {
        return ArrayHelper::map( Type::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'name' );
    }

    public function periodList()
    {
        return ArrayHelper::map( Period::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'description' );
    }

    public function cityList()
    {
        return ArrayHelper::map( Country::find()->orderBy( 'sort' )->asArray()->all(), 'id', 'country_name' );
    }

    protected function internalForms()
    {
        return [ 'priceForm', 'imagesForm' ];
    }
}