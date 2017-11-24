<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 15:31
 * Email: becksonq@gmail.com
 */

namespace board\manage;

use board\forms\ImageForm;
use board\repositories\AdvertsRepository;
use board\services\TransactionManager;
use board\forms\AdvertCreateForm;
use board\entities\Adverts;
use frontend\models\Price;

class AdvertManageService
{
    private $_adverts;
    private $_transaction;

    private $_active = 1;
    private $_selected = null;
    private $_special = null;
    private $_ip = 127001;

    public function __construct( AdvertsRepository $adverts, TransactionManager $transaction )
    {
        $this->_adverts = $adverts;
        $this->_transaction = $transaction;
    }

    public function create( AdvertCreateForm $form )
    {
//        echo '<pre>';
//        var_dump( $form );
//        echo '</pre>';
//        exit;

        $advert = Adverts::create(
            $form->cat_id,
            $form->subcat_id,
            $form->type,
            $form->period,
            $form->header,
            $form->description,
            $form->country,
            $form->username,
            $form->useremail,
            $form->userphone,
            $this->_active,
            $this->_selected,
            $this->_special,
            $this->_ip
        );

        foreach ( $form->imagesForm->files as $file ) {
            $advert->addPhoto( $file );
        }

        return $advert;
    }

    public function addPhotos($id, ImageForm $form)
    {
        $advert = $this->_adverts->get($id);
        /*foreach ($form->files as $file) {
            $advert->addPhoto($file);
        }
        $this->_adverts->save($advert);*/
    }
}