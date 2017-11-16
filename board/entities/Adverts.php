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

class Adverts extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

    public static function tableName()
    {
        return '{{%adverts}}';
    }

    /*public static function create(
        $cat_id,
        $subcat_id,
        $type,
        $period,
        $header,
        $description,
        $city,
        $username,
        $useremail,
        $userphone,
        $active,
        $selected,
        $special,
        $ip
    ){
        $advert = new static();
        $advert->old_id = null;
        $advert->sid = date( 'U' );
        $advert->cat_id = $cat_id;
        $advert->subcat_id = $subcat_id;
        $advert->period = $period;
        $advert->type = $type;
        $advert->header = $header;
        $advert->description = $description;
        $advert->city = $city;
        $advert->username = $username;
        $advert->useremail = $useremail;
        $advert->userphone = $userphone;
        $advert->active = $active;
        $advert->selected_old = $selected;
        $advert->special_old = $special;
        $advert->ip = $ip;
        $advert->created_at = time();
        return $advert;
    }*/

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [ 'images' ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['old_id', 'cat_id', 'subcat_id', 'type', 'city', 'period', 'active', 'selected_old', 'special_old', 'images_old', 'ip', 'created_at', 'updated_at'], 'integer'],
            [['sid', 'cat_id', 'subcat_id', 'type', 'period', 'header', 'city', 'ip', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['sid'], 'string', 'max' => 32],
            [['header', 'author', 'email'], 'string', 'max' => 255],
            [['sid'], 'unique'],
            [['old_id'], 'unique'],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['city' => 'id']],
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
            'city' => 'Город',
            'period' => 'Период',
            'author' => 'Автор',
            'email' => 'Email',
            'active' => 'Active',
            'selected_old' => 'Selected Old',
            'special_old' => 'Special Old',
            'images_old' => 'Images Old',
            'ip' => 'Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

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
    public function getCity0()
    {
        return $this->hasOne(Country::className(), ['id' => 'city']);
    }

    public function releaseEvents(){ }
}