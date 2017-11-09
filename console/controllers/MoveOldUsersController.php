<?php
/**
 * File: actionMoveOldUsers.php
 * Email: becksonq@gmail.com
 * Date: 09.11.2017
 * Time: 11:39
 */

namespace console\controllers;

use yii;
use backend\models\QAuthUserSearch;

class MoveOldUsersController extends yii\console\Controller
{
    /**
     * Функция для переноса старых пользователей из таблицы QAuthUser
     * в новую таблицу User
     */
    public function actionMove()
    {
        $searchModel = new QAuthUserSearch();
        $details = $searchModel->searchDetails();

        $old_users = $details->getModels();

        foreach ( $old_users as $key => $val ) {

            $user = new \dektrium\user\models\User();

            // От старого пользователя берем только email и имя
            // Остальные данные берем из головы
            $user->username = $val['QAuthUserEmail'];
            $user->email = $val['QAuthUserEmail'];
            $user->password_hash = '$2y$10$EvE76ImLLtNj5e1YlayN4.zR9JyJyaQdqYXtVU3K6RV4ciNJpj.72';
            $user->auth_key = 'ArYVZMYHd1PgJjkZo2nVtAFGLl5nk6W3';
            $user->confirmed_at = time();
            $user->registration_ip = '127.0.0.1';
            $user->created_at = time();
            $user->updated_at = time();
            $user->flags = 0;
            $user->last_login_at = null;

            if ( !$user->save() ) {
                $this->stdout( "Don't save user " . PHP_EOL );
            }

            $id = $user->id;

            $name = $val['QAuthUserFullName'];

            if ( Yii::$app->db->createCommand()->update( 'profile', [ 'name' => $name ],
                [ 'user_id' => $id ] )->execute()
            ) {
                $this->stdout( 'Update profile' );
            }
            else {
                $this->stdout( "Can't update profile" . PHP_EOL );
            }
        }

        return 0;
    }
}