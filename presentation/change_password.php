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
    $query = "SELECT * FROM users WHERE id = {$user} LIMIT 1";
    $result_set = mysqli_query($connection, $query);

    foreach ($result_set as $rows) {
        $name = $rows['name'];
        $email = $rows['email'];
        $username = $rows['username'];
        $role = $rows['role'];
        $status = $rows['status'];
        $role = $rows['role'];
    }

    if (isset($_POST['update_password'])) {
        $password  = mysqli_real_escape_string($connection, $_POST['password']);

        $hashed_password = sha1($password);

        $up_query = "UPDATE `users` SET `password`='$hashed_password' WHERE id = '$user' LIMIT 1";
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
                        <h3 class="p-3 text-capitalize">Change Password <?= $name ?></h3>
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
                                    <input type="text" class="form-control form-control-sm" placeholder="Add First and and Last Name" name="name" disabled value="<?= $name ?>">
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
                                    <input type="text" class="form-control form-control-sm" inputmode="text" placeholder="Email Address" name="email" disabled value="<?= $email ?>">
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
                                    <input type="text" class="form-control form-control-sm" inputmode="text" placeholder="Username" name="username" disabled value="<?= $username ?>">
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
                                    <select class="form-select form-control" name="role" disabled aria-label="Default select example">
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

                            <!-- Password -->
                            <div class="form-group">
                                <label>Password: <span class="mx-1 text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-sm" inputmode="text" placeholder="Password" id="password" name="password" required>
                                </div>
                                <!-- /.input group -->

                            </div>
                            <!-- /.form group -->

                            <div class="form-group row">
                                <div class="col-md-11">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checkbox" onclick="showPassword()" class="mt-2"> Show Password
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
                                            <input type="radio" name="status" value="0" checked="checked" disabled id="radioSuccess1">
                                            <label for="radioSuccess1">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="status" value="1" id="radioSuccess2" disabled>
                                            <label for="radioSuccess2">Inactive</label>
                                        </div>
                                    </div>
                                <?php }
                                if ($status == '1') { ?>
                                    <div class="form-group clearfix mx-3">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="status" value="0" id="radioSuccess1" disabled>
                                            <label for="radioSuccess1">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" name="status" value="1" id="radioSuccess2" checked="checked" disabled>
                                            <label for="radioSuccess2">Inactive</label>
                                        </div>
                                    </div>

                                <?php } ?>

                            </div>
                            <!-- /.form group -->

                            <div class="">
                                <button class="btn btn-sm btn-success" type="submit" name="update_password">Change
                                    Password</button>
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
