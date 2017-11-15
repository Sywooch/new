<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 15:31
 * Email: becksonq@gmail.com
 */

namespace board\manage;

use board\repositories\AdvertsRepository;
use board\services\TransactionManager;
use board\forms\AdvertCreateForm;
use board\entities\Advert;
use frontend\models\Price;

class AdvertManageService
{
    private $adverts;
    private $transaction;

    private $_active = 1;
    private $_selected = null;
    private $_special = null;
    private $_ip = 127001;

    /*public function __construct( AdvertsRepository $adverts, TransactionManager $transaction )
    {
        $this->adverts = $adverts;
        $this->transaction = $transaction;
    }*/

    public function create( AdvertCreateForm $form )
    {
        echo '<pre>';
        var_dump( $form );
        echo '</pre>';
        exit;

        $price = new Price();

        /* $advert = Advert::create(
             $form->cat_id,
             $form->subcat_id,
             $form->type,
             $form->period,
             $form->header,
             $form->description,
             $form->city
         );*/
        $advert = Advert::create(
            $form->cat_id,
            $form->subcat_id,
            $form->type,
            $form->period,
            $form->header,
            $form->description,
//            $form->priceForm->price,
//            $price->negotiable = $form->negotiable,
            $form->city,
//            $form->username,
//            $form->useremail,
//            $form->userphone,
            $this->_active,
            $this->_selected,
            $this->_special,
            $this->_ip
        );

        $price->negotiable = $form->negotiable;

        foreach ( $form->images->files as $file ) {
            $advert->addPhoto( $file );
        }

        return $advert;
    }
}