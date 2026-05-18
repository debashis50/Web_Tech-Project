<?php
    // This file goes to GitHub (no password)
    // this file is ignored by git since sensitive information exists
    require_once('db_config.php');

    function get_connection() {
        global $host, $db_name, $db_user, $db_pass;
        $con = mysqli_connect($host, $db_user, $db_pass, $db_name);
        return $con;
    }
?>