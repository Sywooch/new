<?php
/**
 * File: Utf8.php
 * Email: becksonq@gmail.com
 * Date: 28.11.2017
 * Time: 23:04
 */

namespace common\models;


class Utf8
{
#таблица конвертации регистра
    public static $convert_case_table = array(
        #en (английский латиница)
        #CASE_UPPER => case_lower
        "\x41"     => "\x61",
        #A a
        "\x42"     => "\x62",
        #B b
        "\x43"     => "\x63",
        #C c
        "\x44"     => "\x64",
        #D d
        "\x45"     => "\x65",
        #E e
        "\x46"     => "\x66",
        #F f
        "\x47"     => "\x67",
        #G g
        "\x48"     => "\x68",
        #H h
        "\x49"     => "\x69",
        #I i
        "\x4a"     => "\x6a",
        #J j
        "\x4b"     => "\x6b",
        #K k
        "\x4c"     => "\x6c",
        #L l
        "\x4d"     => "\x6d",
        #M m
        "\x4e"     => "\x6e",
        #N n
        "\x4f"     => "\x6f",
        #O o
        "\x50"     => "\x70",
        #P p
        "\x51"     => "\x71",
        #Q q
        "\x52"     => "\x72",
        #R r
        "\x53"     => "\x73",
        #S s
        "\x54"     => "\x74",
        #T t
        "\x55"     => "\x75",
        #U u
        "\x56"     => "\x76",
        #V v
        "\x57"     => "\x77",
        #W w
        "\x58"     => "\x78",
        #X x
        "\x59"     => "\x79",
        #Y y
        "\x5a"     => "\x7a",
        #Z z

        #ru (русский кириллица)
        #CASE_UPPER => case_lower
        "\xd0\x81" => "\xd1\x91",
        #Ё ё
        "\xd0\x90" => "\xd0\xb0",
        #А а
        "\xd0\x91" => "\xd0\xb1",
        #Б б
        "\xd0\x92" => "\xd0\xb2",
        #В в
        "\xd0\x93" => "\xd0\xb3",
        #Г г
        "\xd0\x94" => "\xd0\xb4",
        #Д д
        "\xd0\x95" => "\xd0\xb5",
        #Е е
        "\xd0\x96" => "\xd0\xb6",
        #Ж ж
        "\xd0\x97" => "\xd0\xb7",
        #З з
        "\xd0\x98" => "\xd0\xb8",
        #И и
        "\xd0\x99" => "\xd0\xb9",
        #Й й
        "\xd0\x9a" => "\xd0\xba",
        #К к
        "\xd0\x9b" => "\xd0\xbb",
        #Л л
        "\xd0\x9c" => "\xd0\xbc",
        #М м
        "\xd0\x9d" => "\xd0\xbd",
        #Н н
        "\xd0\x9e" => "\xd0\xbe",
        #О о
        "\xd0\x9f" => "\xd0\xbf",
        #П п

        #CASE_UPPER => case_lower
        "\xd0\xa0" => "\xd1\x80",
        #Р р
        "\xd0\xa1" => "\xd1\x81",
        #С с
        "\xd0\xa2" => "\xd1\x82",
        #Т т
        "\xd0\xa3" => "\xd1\x83",
        #У у
        "\xd0\xa4" => "\xd1\x84",
        #Ф ф
        "\xd0\xa5" => "\xd1\x85",
        #Х х
        "\xd0\xa6" => "\xd1\x86",
        #Ц ц
        "\xd0\xa7" => "\xd1\x87",
        #Ч ч
        "\xd0\xa8" => "\xd1\x88",
        #Ш ш
        "\xd0\xa9" => "\xd1\x89",
        #Щ щ
        "\xd0\xaa" => "\xd1\x8a",
        #Ъ ъ
        "\xd0\xab" => "\xd1\x8b",
        #Ы ы
        "\xd0\xac" => "\xd1\x8c",
        #Ь ь
        "\xd0\xad" => "\xd1\x8d",
        #Э э
        "\xd0\xae" => "\xd1\x8e",
        #Ю ю
        "\xd0\xaf" => "\xd1\x8f",
        #Я я

        #tt (татарский, башкирский кириллица)
        #CASE_UPPER => case_lower
        "\xd2\x96" => "\xd2\x97",
        #Ж ж с хвостиком    &#1174; => &#1175;
        "\xd2\xa2" => "\xd2\xa3",
        #Н н с хвостиком    &#1186; => &#1187;
        "\xd2\xae" => "\xd2\xaf",
        #Y y                &#1198; => &#1199;
        "\xd2\xba" => "\xd2\xbb",
        #h h мягкое         &#1210; => &#1211;
        "\xd3\x98" => "\xd3\x99",
        #Э э                &#1240; => &#1241;
        "\xd3\xa8" => "\xd3\xa9",
        #О o перечеркнутое  &#1256; => &#1257;

        #uk (украинский кириллица)
        #CASE_UPPER => case_lower
        "\xd2\x90" => "\xd2\x91",
        #г с хвостиком
        "\xd0\x84" => "\xd1\x94",
        #э зеркальное отражение
        "\xd0\x86" => "\xd1\x96",
        #и с одной точкой
        "\xd0\x87" => "\xd1\x97",
        #и с двумя точками

        #be (белорусский кириллица)
        #CASE_UPPER => case_lower
        "\xd0\x8e" => "\xd1\x9e",
        #у с подковой над буквой

        #tr,de,es (турецкий, немецкий, испанский, французский латиница)
        #CASE_UPPER => case_lower
        "\xc3\x84" => "\xc3\xa4",
        #a умляут          &#196; => &#228;  (турецкий)
        "\xc3\x87" => "\xc3\xa7",
        #c с хвостиком     &#199; => &#231;  (турецкий, французский)
        "\xc3\x91" => "\xc3\xb1",
        #n с тильдой       &#209; => &#241;  (турецкий, испанский)
        "\xc3\x96" => "\xc3\xb6",
        #o умляут          &#214; => &#246;  (турецкий)
        "\xc3\x9c" => "\xc3\xbc",
        #u умляут          &#220; => &#252;  (турецкий, французский)
        "\xc4\x9e" => "\xc4\x9f",
        #g умляут          &#286; => &#287;  (турецкий)
        "\xc4\xb0" => "\xc4\xb1",
        #i c точкой и без  &#304; => &#305;  (турецкий)
        "\xc5\x9e" => "\xc5\x9f",
        #s с хвостиком     &#350; => &#351;  (турецкий)

        #hr (хорватский латиница)
        #CASE_UPPER => case_lower
        "\xc4\x8c" => "\xc4\x8d",
        #c с подковой над буквой
        "\xc4\x86" => "\xc4\x87",
        #c с ударением
        "\xc4\x90" => "\xc4\x91",
        #d перечеркнутое
        "\xc5\xa0" => "\xc5\xa1",
        #s с подковой над буквой
        "\xc5\xbd" => "\xc5\xbe",
        #z с подковой над буквой

        #fr (французский латиница)
        #CASE_UPPER => case_lower
        "\xc3\x80" => "\xc3\xa0",
        #a с ударением в др. сторону
        "\xc3\x82" => "\xc3\xa2",
        #a с крышкой
        "\xc3\x86" => "\xc3\xa6",
        #ae совмещенное
        "\xc3\x88" => "\xc3\xa8",
        #e с ударением в др. сторону
        "\xc3\x89" => "\xc3\xa9",
        #e с ударением
        "\xc3\x8a" => "\xc3\xaa",
        #e с крышкой
        "\xc3\x8b" => "\xc3\xab",
        #ё
        "\xc3\x8e" => "\xc3\xae",
        #i с крышкой
        "\xc3\x8f" => "\xc3\xaf",
        #i умляут
        "\xc3\x94" => "\xc3\xb4",
        #o с крышкой
        "\xc5\x92" => "\xc5\x93",
        #ce совмещенное
        "\xc3\x99" => "\xc3\xb9",
        #u с ударением в др. сторону
        "\xc3\x9b" => "\xc3\xbb",
        #u с крышкой
        "\xc5\xb8" => "\xc3\xbf",
        #y умляут

        #xx (другой язык)
        #CASE_UPPER => case_lower
        #"" => "",  #

    );

    /**
     * Implementation strlen() function for UTF-8 encoding string.
     *
     * @param   string $s
     * @return  int
     */
    public static function strlen( $s )
    {
        /*
          The fastest!
          utf8_decode() converts characters that are not in ISO-8859-1 to '?', which, for the purpose of counting, is quite alright.
          It's much faster than iconv_strlen()
          Note: this function does not count bad UTF-8 bytes in the string - these are simply ignored
        */
        return strlen( utf8_decode( $s ) );

        /*
        #DEPRECATED, speed less!
        if (function_exists('mb_strlen')) return mb_strlen($s, 'utf-8');
        if (function_exists('iconv_strlen')) return iconv_strlen($s, 'utf-8');

        #Do not count UTF-8 continuation bytes
        #return strlen(preg_replace('/[\x80-\xBF]/sSX', '', $s));

        #Тесты показали, что этот способ работает медленнее, чем хак через utf8_decode()
        preg_match_all('~[\x09\x0A\x0D\x20-\x7E]             # ASCII
                         | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
                         |  \xE0[\xA0-\xBF][\x80-\xBF]       # excluding overlongs
                         | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                         |  \xED[\x80-\x9F][\x80-\xBF]       # excluding surrogates
                         |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
                         | [\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
                         |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
                        ~xs', $str, $m);
        return count($m[0]);

        #Тесты показали, что этот способ работает медленнее, чем через регулярное выражение!
        $n = 0;
        for ($i = 0, $len = strlen($str); $i < $len; $i++)
        {
            $c = ord(substr($str, $i, 1));
            if ($c < 0x80) $n++;                 #single-byte (0xxxxxx)
            elseif (($c & 0xC0) == 0xC0) $n++;   #multi-byte starting byte (11xxxxxx)
        }
        return $n;
        */
    }

    /**
     * Implementation str_split() function for UTF-8 encoding string.
     */
    public static function str_split(/*string*/
        $string, /*int*/
        $length = null,
        $is_strict = true
    ){
        if ( !is_string( $string ) ) {
            trigger_error( 'A string type expected in first parameter, ' . gettype( $string ) . ' given!',
                E_USER_ERROR );
        }
        $length = ( $length === null ) ? 1 : intval( $length );
        if ( $length < 1 ) {
            return false;
        }
        $utf8_char_re = '(?>' . ( $is_strict ? '[\x09\x0A\x0D\x20-\x7E]' : '[\x00-\x7E]' ) . ' # ASCII
                           | [\xC2-\xDF][\x80-\xBF]            # non-overlong 2-byte
                           |  \xE0[\xA0-\xBF][\x80-\xBF]       # excluding overlongs
                           | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                           |  \xED[\x80-\x9F][\x80-\xBF]       # excluding surrogates
                           |  \xF0[\x90-\xBF][\x80-\xBF]{2}    # planes 1-3
                           | [\xF1-\xF3][\x80-\xBF]{3}         # planes 4-15
                           |  \xF4[\x80-\x8F][\x80-\xBF]{2}    # plane 16
                           #| (.)                               # catch bad bytes
                          )';
        #there are limits in regexp for {min,max}!
        if ( $length < 100 ) {
            preg_match_all( '/' . $utf8_char_re . '{1,' . $length . '}/sxSX', $string, $m );
            $a =& $m[0];
        }
        else {
            preg_match_all( '/' . $utf8_char_re . '/sxSX', $string, $m );
            if ( $length === 1 ) {
                $a = $m[0];
            }
            else {
                $a = array();
                for ( $i = 0, $c = count( $m[0] ); $i < $c; $i += $length ) {
                    $a[] = implode( '', array_slice( $m[0], $i, $length ) );
                }
            }
        }
        #check UTF-8 data
        $distance = strlen( $string ) - strlen( implode( '', $a ) );
        if ( $distance > 0 ) {
            //trigger_error('Charset is not UTF-8, total ' . $distance . ' unknown bytes found!', E_USER_WARNING);
            return false;
        }
        return $a;
    }

    /**
     * Implementation substr() function for UTF-8 encoding string.
     *
     * @link     http://www.w3.org/International/questions/qa-forms-utf-8.html
     * @param    string $str
     * @param    int $offset
     * @param    int $length
     * @return   string
     */
    public static function substr( $str, $offset, $length = null )
    {
        if ( $str == null ) {
            return false;
        }

        if ( $str == '' ) {
            return false;
        }

        static $_str = null;
        static $_a = null;
        #try to find standard functions
        #iconv_substr() faster then mb_substr()!
//        if (function_exists('iconv_substr'))
//        {
//            return iconv_substr($str, $offset, $length, 'utf-8'); #(PHP 5)
//        }
//        if (function_exists('mb_substr')) return mb_substr($str, $offset, $length, 'utf-8'); #(PHP 4 >= 4.0.6, PHP 5)
        #speed improve for calling self::substr() in cycles with the same $str and different $offset/$length!
        if ( $_str !== $str ) {
            $_a = self::str_split( $_str = $str );
        }
        if ( !is_array( $_a ) ) {
            return false;
        }
        if ( $length !== null ) {
            $a = array_slice( $_a, $offset, $length );
        }
        else {
            $a = array_slice( $_a, $offset );
        }
        return implode( '', $a );
    }

    /**
     * Call preg_match_all() and convert byte offsets into character offsets for PREG_OFFSET_CAPTURE flag.
     * This is regardless of whether you use /u modifier.
     */
    public static function preg_match_all(
        /*string*/
        $pattern,
        /*string*/
        $subject,
        /*array*/
        &$matches,
        /*int*/
        $flags = PREG_PATTERN_ORDER,
        /*int*/
        $char_offset = 0
    ){
        $byte_offset = ( $char_offset > 0 ) ? strlen( self::substr( $subject, 0, $char_offset ) ) : $char_offset;

        $return = preg_match_all( $pattern, $subject, $matches, $flags, $byte_offset );
        if ( $return === false ) {
            return false;
        }

        if ( $flags & PREG_OFFSET_CAPTURE ) {
            foreach ( $matches as &$match ) {
                foreach ( $match as &$a ) {
                    $a[1] = self::strlen( substr( $subject, 0, $a[1] ) );
                }
            }
        }

        return $return;
    }

    /**
     * Implementation strcasecmp() function for UTF-8 encoding string.
     */
    public static function casecmp( $s1, $s2 )
    {
        return strcmp( self::lowercase( $s1 ), self::lowercase( $s2 ) );
    }

    public static function lowercase( $s )
    {
        return self::convert_case( $s, CASE_LOWER );
    }

    public static function uppercase( $s )
    {
        return self::convert_case( $s, CASE_UPPER );
    }

    /**
     * Конвертирует регистр букв в строке в кодировке UTF-8
     *
     * @link     http://www.unicode.org/charts/PDF/U0400.pdf
     * @link     http://ru.wikipedia.org/wiki/ISO_639-1
     * @param    string $s строка
     * @param    int $mode {CASE_LOWER|CASE_UPPER}
     * @return   string|array
     */
    public static function convert_case( $s, $mode )
    {
        if ( $mode === CASE_UPPER ) {
            if ( !$s ) {
                return $s;
            }
            if ( preg_match( '/^[\x00-\x7e]*$/sSX', $s ) ) {
                return strtoupper( $s );
            } #speed improve!
            if ( function_exists( 'mb_strtoupper' ) ) {
                return mb_strtoupper( $s, 'utf-8' );
            }
            return strtr( $s, array_flip( self::$convert_case_table ) );
        }
        elseif ( $mode === CASE_LOWER ) {
            if ( !$s ) {
                return $s;
            }
            if ( preg_match( '/^[\x00-\x7e]*$/sSX', $s ) ) {
                return strtolower( $s );
            } #speed improve!
            if ( function_exists( 'mb_strtolower' ) ) {
                return mb_strtolower( $s, 'utf-8' );
            }
            return strtr( $s, self::$convert_case_table );
        }
        else {
            trigger_error( 'Parameter 2 should be a constant of CASE_LOWER or CASE_UPPER!', E_USER_WARNING );
            return $s;
        }
        return $s;
    }

    /**
     * Implementation chunk_split() function for UTF-8 encoding string.
     */
    public static function chunk_split(/*string*/
        $string, /*int*/
        $length = null, /*string*/
        $glue = null
    ){
        if ( !is_string( $string ) ) {
            trigger_error( 'A string type expected in first parameter, ' . gettype( $string ) . ' given!',
                E_USER_ERROR );
        }
        $length = intval( $length );
        $glue = strval( $glue );
        if ( $length < 1 ) {
            $length = 76;
        }
        if ( $glue === '' ) {
            $glue = "\r\n";
        }
        if ( !is_array( $a = self::str_split( $string, $length ) ) ) {
            return false;
        }
        return implode( $glue, $a );
    }

    /**
     * Implementation strpos() function for UTF-8 encoding string
     *
     * @param    string $haystack The entire string
     * @param    string $needle The searched substring
     * @param    int $offset The optional offset parameter specifies the position from which the search should be performed
     * @return   mixed(int/false)             Returns the numeric position of the first occurrence of needle in haystack.
     *                                        If needle is not found, self::strpos() will return FALSE.
     */
    public static function strpos( $haystack, $needle, $offset = null )
    {
        if ( $offset === null || $offset < 0 ) {
            $offset = 0;
        }
        if ( function_exists( 'mb_strpos' ) ) {
            return mb_strpos( $haystack, $needle, $offset, 'utf-8' );
        }
//        if (function_exists('iconv_strpos')) return iconv_strpos($haystack, $needle, $offset, 'utf-8');
        $byte_pos = $offset;
        do {
            if ( ( $byte_pos = strpos( $haystack, $needle, $byte_pos ) ) === false ) {
                return false;
            }
        } while ( ( $char_pos = self::strlen( substr( $haystack, 0, $byte_pos++ ) ) ) < $offset );
        return $char_pos;
    }

    /**
     * Implementation ucfirst() function for UTF-8 encoding string.
     * Преобразует первый символ строки в кодировке UTF-8 в верхний регистр.
     *
     * @param   string $s
     * @parm    bool      $is_other_to_lowercase  остальные символы преобразуются в нижний регистр?
     * @return  string
     */
    public static function ucfirst( $s, $is_other_to_lowercase = true )
    {
        if ( $s === '' or !is_string( $s ) ) {
            return $s;
        }
        if ( !preg_match( '/^(.)(.*)$/usSX', $s, $m ) ) {
            return false;
        }
        return self::uppercase( $m[1] ) . ( $is_other_to_lowercase ? self::lowercase( $m[2] ) : $m[2] );
    }

    /**
     * Implementation ucwords() function for UTF-8 encoding string.
     * Преобразует в верхний регистр первый символ каждого слова в строке в кодировке UTF-8,
     * остальные символы каждого слова преобразуются в нижний регистр.
     * Эта функция считает словами последовательности символов, разделенных пробелом, переводом строки, возвратом каретки, горизонтальной табуляцией, неразрывным пробелом.
     *
     * @param   string $s
     * @return  string
     */
    public static function ucwords( $s )
    {
        $words = preg_split( '/([\x20\r\n\t]++|\xc2\xa0)/sSX', $s, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE );
        foreach ( $words as $k => $word ) {
            $words[$k] = self::ucfirst( $word, $is_other_to_lowercase = true );
        }
        return implode( '', $words );
    }
}