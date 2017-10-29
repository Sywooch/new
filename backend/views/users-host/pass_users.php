<?php
/**
 * File: pass_users.php
 * Email: becksonq@gmail.com
 * Date: 26.10.2017
 * Time: 19:58
 */

while ($row = mysqli_fetch_assoc($old_user)) {
    printf ("%s (%s)\n", $row["QAuthUserEmail"], $row["QAuthUserUserName"]);
}

//foreach ( $old_users as $val ){
//    print $val->QAuthUserEmail;
//}