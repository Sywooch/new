<?php
/**
 * File: Advert.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 12:25
 */

namespace board\entities;

use frontend\models\UserPhones;
use Yii;
use backend\models\Pricies;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;
use backend\models\Countries;
use backend\models\Category;
use backend\models\Subcategory;
use backend\models\Periods;
use backend\models\Types;
use frontend\models\Images;
use common\models\Helpers;

/**
 * This is the model class for table "{{%adverts}}".
 *
 * @property integer $id
 * @property integer $old_id
 * @property string $sid
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property integer $type_id
 * @property string $header
 * @property string $description
 * @property integer $country_id
 * @property integer $period_id
 * @property string $author
 * @property string $email
 * @property integer $active
 * @property integer $selected
 * @property integer $selected_old
 * @property integer $special
 * @property integer $special_old
 * @property integer $images_old
 * @property integer $ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $draft
 *
 * @property Category $cat
 * @property Countries $countries
 * @property Periods $periods
 * @property Subcategory $subcategory
 * @property Types $type
 * @property Pricies $pricies
 * @property Images $images
 */
class Adverts extends ActiveRecord
{
    use EventTrait;

    /**
     * @var
     */
    public $verifyCode;

    /**
     * Свойство для временной маркировки изображений
     * @var
     */
    public $marker;

    // Черновик объявления
    const STATUS_DRAFT = 1;
    // Опуликованное объявление
    const STATUS_PUBLISHED = 0;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const DEFAULT_PAGE_SIZE = 25;

    const PAGE_SIZE_LIMIT_MIN = 15;
    const PAGE_SIZE_LIMIT_MAX = 100;

    const HAS_IMAGES = 1;
    const HAS_NOT_IMAGES = 0;

    public static function tableName()
    {
        return '{{%adverts}}';
    }

    public function behaviors()
    {
        return [
            [
                'class'     => SaveRelationsBehavior::className(),
                'relations' => [ 'images' ],
            ],
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at', 'updated_at' ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [ 'updated_at' ],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [
                [
                    'old_id',
                    'cat_id',
                    'subcat_id',
                    'type_id',
                    'country_id',
                    'period_id',
                    'active',
                    'selected',
                    'selected_old',
                    'special',
                    'special_old',
                    'images_old',
                    'ip',
                    'created_at',
                    'updated_at',
                    'draft',
                    'marker',
                    'has_images',
                    'views',
                ],
                'integer'
            ],
            [
                [
                    'sid',
                    'cat_id',
                    'subcat_id',
                    'type_id',
                    'header',
                    'description',
                    'author',
                    'email',
                    'period_id',
                    'country_id',
                    'ip',
                ],
                'required'
            ],
            [ [ 'description' ], 'string' ],
            [ [ 'sid' ], 'string', 'max' => 32 ],
            [ [ 'header', 'author', 'email' ], 'string', 'max' => 255 ],
            [ 'email', 'email' ],
            [ [ 'old_id' ], 'unique' ],
            [ [ 'cat_id' ], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => [ 'cat_id' => 'id' ] ],
            [
                [ 'country_id' ],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Countries::className(),
                'targetAttribute' => [ 'country_id' => 'id' ]
            ],
            [
                [ 'period_id' ],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Periods::className(),
                'targetAttribute' => [ 'period_id' => 'id' ]
            ],
            [ [ 'subcat_id' ], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => [ 'subcat_id' => 'id' ] ],
            [
                [ 'type_id' ],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => Types::className(),
                'targetAttribute' => [ 'type_id' => 'id' ]
            ],
            //            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'     => 'ID',
            'old_id' => 'Old ID',
            'sid'    => 'Sid',

            'cat_id'    => 'Раздел',
            'subcat_id' => 'Подраздел',
            'type_id'   => 'Тип',

            'header'      => 'Заголовок',
            'description' => 'Описание',
            'country_id'  => 'Расположение',

            'period_id' => 'Период',
            'author'    => 'Автор',
            'email'     => 'Email',

            'active'       => 'Active',
            'selected'     => 'Selected',
            'selected_old' => 'Selected Old',

            'special'     => 'Special',
            'special_old' => 'Special Old',
            'images_old'  => 'Images Old',

            'ip'         => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'draft'      => 'Draft',

            'has_images' => 'Has_images',
            'views' => 'Просмотров',

            'verifyCode' => 'Проверочный код',
        ];
    }

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if ( $this->isNewRecord ) {
            $this->sid = Yii::$app->session->id;
            $this->ip = Helpers::IpToNum( Yii::$app->request->userIP );
            return true;
        }
        return parent::beforeValidate();
    }

    /*public function addPhoto( UploadedFile $file )
    {
        $image = $this->photos;
        $image[] = Image::create( $file );
        $this->updateImages( $image );
    }

    private function updateImages( array $photos )
    {
        foreach ( $photos as $i => $photo ) {
            $photo->setSort( $i );
        }
        $this->photos = $photos;
        $this->populateRelation( 'mainPhoto', reset( $photos ) );
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne( Category::className(), [ 'id' => 'cat_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne( Countries::class, [ 'id' => 'country_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriod()
    {
        return $this->hasOne( Periods::class, [ 'id' => 'period_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne( Subcategory::class, [ 'id' => 'subcat_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne( Types::class, [ 'id' => 'type_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrice()
    {
        return $this->hasOne( Pricies::class, [ 'ad_id' => 'id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasOne( Images::class, [ 'ad_id' => 'id' ] );
    }

    public function getPhones()
    {
        return $this->hasMany( UserPhones::class, [ 'ad_id' => 'id' ] );
    }
}