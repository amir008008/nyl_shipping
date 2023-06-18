<?php

session_start();
include_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}


$info_id = $_GET['info_id'];

$sql = "DELETE FROM `container` WHERE info_id = '$info_id'";
$run = mysqli_query($connection, $sql);

if ($run) {
    header('Location: dashboard');
} else {
    echo '<script>alert("Something went wrong")</script>';
}
