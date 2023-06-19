<?php

// try {

// } catch (Exception $event) {
//     echo $event->getMessage();
// }

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "nyl_shipping";

if ($connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    // echo "DB Successfully Connected";
} else {
    echo "Something Wrong";
}
