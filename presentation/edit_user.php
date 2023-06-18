<?php

session_start();
include_once '../inc/header.php';
include_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}


$user = $_GET['user_id'];

if (isset($_GET['user_id'])) {
    // getting the user information
    $query = "SELECT * FROM users WHERE id =F {$user} LIMIT 1";
    $result_set = mysqli_query($connection, $query);

    foreach ($result_set as $rows) {
        $name = $rows['name'];
        $email = $rows['email'];
        $username = $rows['username'];
        $role = $rows['role'];
        $status = $rows['status'];
        $role = $rows['role'];
    }

    if (isset($_POST['update_user'])) {
        $name  = mysqli_real_escape_string($connection, $_POST['name']);
        $email  = mysqli_real_escape_string($connection, $_POST['email']);
        $username  = mysqli_real_escape_string($connection, $_POST['username']);
        $role  = mysqli_real_escape_string($connection, $_POST['role']);
        $password  = mysqli_real_escape_string($connection, $_POST['password']);
        $status  = mysqli_real_escape_string($connection, $_POST['status']);

        $hashed_password = sha1($password);

        $up_query = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$username',`role`='$role',`password`='$hashed_password',`status`='$status' WHERE id = '$user' LIMIT 1";
        echo $up_query;
        $query_run = mysqli_query($connection, $up_query);

        if ($query_run) {
            header("Location: ./users");
        } else {
            echo "<script>alert('There is something wrong with inserting to the database please check or connect the developer')</script>";
        }
    }
}


?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="p-3 text-capitalize">Edit <?= $name ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Name:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" placeholder="Add First and and Last Name" name="name" value="<?= $name ?>">
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- email -->
                            <div class="form-group">
                                <label>Email Address:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" inputmode="text" placeholder="Email Address" name="email" value="<?= $email ?>">
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- username -->
                            <div class="form-group">
                                <label>Username:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" inputmode="text" placeholder="Username" name="username" value="<?= $username ?>">
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- Role -->
                            <div class="form-group">
                                <label>User Role:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <select class="form-select form-control" name="role" aria-label="Default select example">
                                        <option selected value="<?php echo $role ?>">
                                            <?= $role == '2' ? "Admin" : "Printer" ?>
                                        </option>
                                        <option value="1">Printer</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <div class="form-group row">
                                <div class="col-md-11">
                                    <div class="checkbox">
                                        <label>
                                            <a href="change_password?user_id=<?php echo $rows['id'] ?>">Change
                                                Password</a>
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group d-flex">
                                <label>Status:</label>

                                <?php if ($status == '0') { ?>
                                    <div class="form-group clearfix mx-3">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="status" value="0" checked="checked" id="radioSuccess1">
                                            <label for="radioSuccess1">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="status" value="1" id="radioSuccess2">
                                            <label for="radioSuccess2">Inactive</label>
                                        </div>
                                    </div>
                                <?php }
                                if ($status == '1') { ?>
                                    <div class="form-group clearfix mx-3">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="status" value="0" id="radioSuccess1">
                                            <label for="radioSuccess1">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="status" value="1" id="radioSuccess2" checked="checked">
                                            <label for="radioSuccess2">Inactive</label>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                            <!-- /.form group -->

                            <div class="">
                                <button class="btn btn-sm btn-success" type="submit" name="update_user">Update
                                    User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const showPassword = () => {
        let password = document.getElementById('password');
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = "password";
        }
    }
</script>

<?php include_once '../inc/footer.php';
