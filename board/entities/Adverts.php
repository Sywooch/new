<?php
/**
 * File: Advert.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 12:25
 */

namespace board\entities;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use backend\models\Country;
use backend\models\Category;
use backend\models\Subcategory;
use backend\models\Period;
use backend\models\Type;

class Adverts extends ActiveRecord
{
    use EventTrait;

//    public $form;

    public static function tableName()
    {
        return '{{%adverts}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [ 'images' ],
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['old_id', 'cat_id', 'subcat_id', 'type', 'countries', 'periods', 'active', 'selected', 'selected_old', 'special', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at'], 'integer'],
            [['sid', 'cat_id', 'subcat_id', 'type', 'header', 'countries', 'ip',], 'required'],
            [['description'], 'string'],
            [['sid'], 'string', 'max' => 32],
            [['header', 'author', 'email'], 'string', 'max' => 255],
            [['sid'], 'unique'],
            [['old_id'], 'unique'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['countries'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countries' => 'id']],
            [['periods'], 'exist', 'skipOnError' => true, 'targetClass' => Period::className(), 'targetAttribute' => ['periods' => 'id']],
            [['subcat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['subcat_id' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_id' => 'Old ID',
            'sid' => 'Sid',

            'cat_id' => 'Раздел',
            'subcat_id' => 'Подраздел',
            'type' => 'Тип',

            'header' => 'Заголовок',
            'description' => 'Описание',
            'countries' => 'Расположение',

            'periods' => 'Период',
            'author' => 'Автор',
            'email' => 'Email',

            'active' => 'Active',
            'selected' => 'Selected',
            'selected_old' => 'Selected Old',

            'special' => 'Special',
            'special_old' => 'Special Old',
            'images_old' => 'Images Old',

            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /*public function createForm(){
        $this->form->model = new Adverts();
        $_category = $this->_categoryList();
        $type = $this->_typeList();
        $_period = $this->_periodList();
        $_city = $this->_cityList();
        $price = new Price();
        $_currency = $this->_currencyList();
        $currency = new Currency();
        $phone = new UserPhones();
    }*/

    public function addPhoto( UploadedFile $file )
    {
        $image = $this->photos;
        $image[] = Image::create( $file );
        $this->updateImages( $image );
    }

    private function updateImages(array $photos)
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'countries']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne(Period::className(), ['id' => 'periods']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type']);
    }

    public function releaseEvents(){ }
}