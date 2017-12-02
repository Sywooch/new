<?php
/**
 * File: AdvertsViewsController.php
 * Email: becksonq@gmail.com
 * Date: 02.12.2017
 * Time: 5:36
 */

namespace frontend\controllers;


use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use board\manage\AdvertManageService;

class AdvertsViewsController extends Controller
{
    public $layout = 'main';

    private $_service;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [ 'subcategory-page' ],
                        'allow'   => true,
                    ],
                    [
                        'actions' => [],
                        'allow'   => true,
                        'roles'   => [ '@' ],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [];
    }

    /**
     * AdvertsViewsController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param AdvertManageService $service
     * @param array $config
     */
    public function __construct( $id, $module, AdvertManageService $service, $config = [] )
    {
        parent::__construct( $id, $module, $config );
        $this->_service = $service;
    }

    /**
     * @return string
     */
    public function actionSubcategoryPage()
    {
        return $this->render( 'subcategory-page', [

        ] );
    }
}