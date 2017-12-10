<?php

namespace frontend\profile\controllers;

use yii\web\Controller;
use dektrium\user\controllers\AdminController;

/**
 * Default controller for the `uprofile` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
//        $user = new AdminController( $id );
        return $this->render('index');
    }
}
