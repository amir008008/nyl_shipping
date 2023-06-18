<?php

session_start();
require_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}


echo $user = $_GET['user_id'];

$run = "DELETE FROM users WHERE id = '$user'";
$run_q = mysqli_query($connection, $run);

if ($run_q) {
    header("Location: ./users");
} else {
    echo "<script>alert('There is something wrong with inserting to the database please check or connect the developer')</script>";
}
