<?php
/**
 * File: Advert.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 12:25
 */

namespace board\entities;

use backend\models\Currencies;
use backend\models\Pricies;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use backend\models\Countries;
use backend\models\Category;
use backend\models\Subcategory;
use backend\models\Periods;
use backend\models\Types;

class Adverts extends ActiveRecord
{
    use EventTrait;

    public $verifyCode;

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
            [[ 'old_id','cat_id','subcat_id','type','country','period','active','selected','selected_old','special','special_old','images_old',
                    'ip',
                    'created_at',
                    'updated_at',
                    'draft'
                ], 'integer'
            ],
            [[ 'sid','cat_id','subcat_id','type','header','description','author','email','period','country','ip',],'required'],
            [ [ 'description' ], 'string' ],
            [ [ 'sid' ], 'string', 'max' => 32 ],
            [ [ 'header', 'author', 'email' ], 'string', 'max' => 255 ],
            [ 'email', 'email' ],
            [ [ 'sid', 'old_id' ], 'unique' ],
//            [ [ 'old_id' ], 'unique' ],
//            [ [ 'phones' ], 'required' ],
            [[ 'cat_id' ], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => [ 'cat_id' => 'id' ]],
            [[ 'country' ], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => [ 'country' => 'id' ]],
            [[ 'period' ], 'exist', 'skipOnError' => true, 'targetClass' => Periods::className(), 'targetAttribute' => [ 'period' => 'id' ]],
            [[ 'subcat_id' ], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => [ 'subcat_id' => 'id' ]],
            [[ 'type' ], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => [ 'type' => 'id' ]],
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
            'type'      => 'Тип',

            'header'      => 'Заголовок',
            'description' => 'Описание',
            'country'     => 'Расположение',

            'period' => 'Период',
            'author' => 'Автор',
            'email'  => 'Email',

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
            'verifyCode' => 'Проверочный код',
        ];
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
    public function getCountries()
    {
        return $this->hasOne( Countries::className(), [ 'id' => 'country' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriods()
    {
        return $this->hasOne( Periods::className(), [ 'id' => 'period' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne( Subcategory::className(), [ 'id' => 'subcat_id' ] );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne( Types::className(), [ 'id' => 'type' ] );
    }

    public function getPricies()
    {
        return $this->hasOne( Pricies::className(), [ 'ad_id' => 'id' ] );
    }


    public function releaseEvents(){ }
}