<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>CMA | CGM</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/dashboard.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i"
        rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="./dashboard" class="logo">
                    <img src="../assets/img/Image2.png" width="100" height="45" alt="">
                    <!-- <span>CMA | CGM</span> -->
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <!-- <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin"> -->
                            <span class="status online"></span>
                        </span>
                        <span class="text-capitalize"><?= $_SESSION['username'] ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="./dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <?php if ($_SESSION['role'] == 2) { ?>
                        <!-- <li class="">
                            <a href="./signature"><i class="fa fa-sign"></i> <span>Signature</span></a>
                        </li> -->

                        <li class="menu-title">Other Elements</li>

                        <li>
                            <a href="./users"><i class="fa fa-users"></i> <span>Users</span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>