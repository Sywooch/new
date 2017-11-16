<?php
/**
 * File: Helpers.php
 * Email: becksonq@gmail.com
 * Date: 27.10.2017
 * Time: 21:27
 */

namespace common\models;


class Helpers
{
    /**
     * Функция для перевода типа объявления
     *
     * @param $arg
     * @return string
     */
    public function convertType( $arg )
    {
        $type = '';

        switch ( $arg ) {
            case 1:
                $type = 'Продам';
                break;
            case 2:
                $type = 'Сдам';
                break;
            case 3:
                $type = 'Сниму';
                break;
            case 4:
                $type = 'Предлагаю';
                break;
            case 5:
                $type = 'Воспользуюсь';
                break;
            case 6:
                $type = 'Ищу';
                break;
            case 7:
                $type = 'Отдам';
                break;
            case 8:
                $type = 'Приму в дар';
                break;
            case 9:
                $type = 'Обменяю';
                break;
        }

        return $type;
    }

    /**
     * Функция для перевода ip в integer
     * @param $ip
     * @return int|number
     */
    public static function IpToNum( $ip )
    {
        if ( $ip == "" ) {
            return 0;
        }
        $num = explode( ".", $ip );
        return hexdec( sprintf( "%02x%02x%02x%02x", $num[0], $num[1], $num[2], $num[3] ) );
    }

    /**
     * Функция для перевода integer в ip
     * @param $num
     * @return string
     */
    public static function NumToIp( $num )
    {
        $ip = $num + 0.0;
        return sprintf( "%d.%d.%d.%d", ( $ip >> 24 & 0xFF ), ( $ip >> 16 & 0xFF ),
            ( $ip >> 8 & 0xFF ), ( $ip & 0xFF ) );
    }

}