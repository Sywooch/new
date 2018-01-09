<?php
/**
 * User: Администратор
 * Date: 05.04.2017
 * Time: 23:19
 */

namespace frontend\widgets\catmenu;

use common\models\Helpers;
use yii;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Query;
use backend\models\Category;

class CatmenuTabs extends Widget
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

        return $this->render( 'index', [
            'items' => $this->_getItems( $this->_getCategory() )
        ] );
    }

    /**
     * @return array|null|yii\db\ActiveRecord[]
     */
    private function _getCategory()
    {
        $category = Category::find()
            ->asArray()
            ->joinWith( [
                'subcategories' => function ( $q ){
                    $q->orderBy( 'sort' );
                }
            ] )
            ->orderBy( 'sort' )
            ->all();

        if ( !$category ) {
            return null;
        }
        return $category;
    }

    /**
     * @param $array
     * @return array
     */
    private function _getItems( $array )
    {
        $i = 0;
        $extra_items = [];
        $sub_category = [];
        $items = [];

        foreach ( $array as $value ) {
            if ( $i >= 5 ) {
                array_push( $extra_items, [
                    'label' => Html::encode( $value['category_name'] ),
                    'url'   => Url::to( [
                        'adverts-views/category-page',
                        'id'     => $value['id'],
                        'cat' => $value['category_name']
                    ] )
                ] );
            }
            else {

                foreach ( $value['subcategories'] as $val ) {

                    array_push( $sub_category, [
                        'label' => Html::encode( $val['subcat_name'] ),
                        'url'   => Url::to( [
                            'adverts-views/subcategory-page',
                            'catid'     => $value['id'],
                            'id' => $val['id'],
                            'cat' => $value['category_name'],
                            'subcat' => $val['subcat_name']
                        ] )
                    ] );

                }
                unset( $val );

                array_push( $items, [
                    'label' => Html::encode( $value['category_name'] ),
                    'items' => $sub_category
                ] );
                $sub_category = [];
            }

            $i++;
        }
        unset( $value );

        array_push( $items, [ 'label' => 'Прочее', 'items' => $extra_items ] );

        return $items;
    }
}