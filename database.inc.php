<?php

include_once('config.inc.php');

function db_connect($host, $uname, $passwd) {
    $db_con = mysqli_connect($host, $uname, $passwd);
    if ($db_con->connect_error) {
        echo "<p class=\"error\">error: $db_con->connect_error</p>";
    }
    $r = $db_con->set_charset("utf8");
    db_hasErrors($db_con, $r);
    return $db_con;
}

function db_hasErrors($db_con, $result) {
    if(!$result){
        if (PRINT_DB_ERRORS) {
            echo "<p class=\"error\">error: " . mysqli_error($db_con) . "</p>";
        }
        return true;
    }
    return false;
}

?>
