<?php

session_start();
require_once 'dataAccess/connections.php';

if (isset($_POST['login'])) {
    $errors = array();

    // check if the username and password has been entered
    if (!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1) {
        $errors[] = 'Username is Missing / Invalid';
    }

    if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1) {
        $errors[] = 'Password is Missing / Invalid';
    }

    // check if there are any errors in the form
    if (empty($errors)) {
        // save username and password into variables
        $username     = mysqli_real_escape_string($connection, $_POST['username']);
        $password     = mysqli_real_escape_string($connection, $_POST['password']);
        $hashed_password = sha1($password);

        // prepare database query
        $query = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$hashed_password}' AND `status` = 0 LIMIT 1";
        $result_set = mysqli_query($connection, $query);

        if (mysqli_num_rows($result_set) == 1) {
            // valid user found
            $user = mysqli_fetch_assoc($result_set);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['username'] = $user['username'];


            header('Location: presentation/dashboard');
        } else {
            // user name and password invalid
            $errors[] = 'Invalid Username / Password';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>NYL | Shipping</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
        rel="stylesheet">
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <form class="form-signin" method="POST">
                        <div class="account-logo">
                            <a href="index.html">
                                <!-- <img src="assets/img/logo-dark.png" alt=""> -->
                                <h3>CMA | CGM</h3>
                            </a>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" autofocus="" class="form-control" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <?php

                        if (isset($errors) && !empty($errors)) {
                            echo '<div class="alert alert-danger"><span>Invalid Username / Password</span> </div>';
                        }

                        ?>

                        <div class="form-group text-center">
                            <button href="" type="submit" class="btn btn-primary account-btn"
                                name="login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>