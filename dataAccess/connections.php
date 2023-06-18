<?php

try {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "nyl_shipping";

    if ($connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
        // echo "DB Successfully Connected";
    } else {
        throw new Exception('Database unable to connect') . mysqli_connect_error();
    }
} catch (Exception $event) {
    echo $event->getMessage();
}