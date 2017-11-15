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

class AdvertManageService
{
    private $adverts;
    private $transaction;

//    private $active = 1;
//    private $selected = null;
//    private $special = null;
//    private $ip;

    /*public function __construct( AdvertsRepository $adverts, TransactionManager $transaction )
    {
        $this->adverts = $adverts;
        $this->transaction = $transaction;
    }*/

    public function create(AdvertCreateForm $form)
    {
        $advert = Advert::create(
            $form->cat_id,
            $form->subcat_id,
            $form->type,
            $form->period,
            $form->header,
            $form->description,
            $form->price,
            $form->negotiable,
            $form->city,
            $form->username,
            $form->useremail,
            $form->userphone,
            $form->active,
            $form->selected,
            $form->special,
            $form->ip
        );

        foreach ( $form->images->files as $file ) {
            $advert->addPhoto( $file );
        }

        return $advert;
    }
}