<?php
/**
 * Сортировка объявлений
 *
 * File: AdSort.php
 * Email: becksonq@gmail.com
 * Date: 03.12.2017
 * Time: 11:53
 */

namespace frontend\widgets\adsort;


use yii\base\Widget;

class AdSort extends Widget
{
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     */
    public function run()
    {
        parent::run();

        return $this->render( 'index', [ ] );
    }
}