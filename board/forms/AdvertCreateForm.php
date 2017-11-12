<?php
/**
 * File: AdvertCreateForm.php
 * Email: becksonq@gmail.com
 * Date: 11.11.2017
 * Time: 22:13
 */

namespace board\forms;

use yii\helpers\ArrayHelper;
use backend\models\Category;
use backend\models\Subcategory;
use backend\models\Type;
use backend\models\Period;

class AdvertCreateForm extends CompositeForm
{
    public $cat_id;
    public $subcat_id;
    public $period;
    public $type;
    public $header;
    public $description;
    public $price;

    public function __construct( $config = [] )
    {
        $this->price = new PriceForm();
        $this->images = new ImageForm();
        parent::__construct( $config );
    }

    public function rules()
    {
        return [
            [ [ 'cat_id', 'subcat_id', 'period', 'type', 'header', 'description' ], 'required' ],
            [ [ 'cat_id', 'subcat_id' ], 'string', 'max' => 50 ],
            [ ['description'], 'string', 'max' => 255 ],
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
            'city'        => 'Город',
            'price'       => 'Цена',
            'images'      => 'Фотографии',
        ];
    }

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

    public function negotiableCheck(){

    }

    protected function internalForms()
    {
        return [ 'images' ];
    }
}