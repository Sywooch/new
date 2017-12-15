<?php
/**
 * File: ProfileController.php
 * Email: becksonq@gmail.com
 * Date: 14.12.2017
 * Time: 20:13
 */

namespace frontend\controllers\user;

use dektrium\user\controllers\ProfileController as BaseProfileController;
use yii\filters\AccessControl;

class ProfileController extends BaseProfileController
{
    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [ 'allow' => true, 'actions' => [ 'index' ], 'roles' => [ '@' ] ],
                    [ 'allow' => true, 'actions' => [ 'show' ], 'roles' => [ '?', '@' ] ],
                ],
            ],
        ];
    }

    /**
     * Redirects to current user's profile.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        echo 'kkk'; die;
        return parent::actionIndex();
    }
}