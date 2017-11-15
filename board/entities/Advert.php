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

class Advert extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

    public static function tableName()
    {
        return '{{%adverts}}';
    }

    public static function create(
        $cat_id,
        $subcat_id,
        $type,
        $period,
        $header,
        $description,
//        $price,
        $negotiable,
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
//        $advert->price = $price;
        $advert->negotiable = $negotiable;
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
    }

    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [ 'images' ],
            ],
        ];
    }

    public function addPhoto(UploadedFile $file)
    {
        $photos = $this->photos;
        $photos[] = Image::create($file);
        $this->updatePhotos($photos);
    }

    public function releaseEvents(){ }
}