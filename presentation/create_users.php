<?php

session_start();
include_once '../inc/header.php';
include_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}

$username = $_SESSION['username'];

if (isset($_POST['create_user'])) {
    $name  = mysqli_real_escape_string($connection, $_POST['name']);
    $email  = mysqli_real_escape_string($connection, $_POST['email']);
    $username  = mysqli_real_escape_string($connection, $_POST['username']);
    $role  = mysqli_real_escape_string($connection, $_POST['role']);
    $password  = mysqli_real_escape_string($connection, $_POST['password']);
    $status  = mysqli_real_escape_string($connection, $_POST['status']);

    $hashed_password = sha1($password);

    $query = "INSERT INTO `users`(`name`, `email`, `username`, `role`, `password`, `status`, `created_by`, `created_time`) VALUES 
                ('$name', '$email', '$username', '$role', '$hashed_password', '$status', '$username', NOW())";
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        header("Location: ./users");
    } else {
        echo "<script>alert('There is something wrong with inserting to the database please check or connect the developer')</script>";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="p-3">Create New User</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <!-- Date dd/mm/yyyy -->
                            <div class="form-group">
                                <label>Name: <span class="mx-1 text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="Add First and and Last Name" name="name" required>
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- email -->
                            <div class="form-group">
                                <label>Email Address: <span class="mx-1 text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" inputmode="text"
                                        placeholder="Email Address" name="email" required>
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- username -->
                            <div class="form-group">
                                <label>Username: <span class="mx-1 text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-lock"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" inputmode="text"
                                        placeholder="Username" name="username" required>
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- Role -->
                            <div class="form-group">
                                <label>User Role: <span class="mx-1 text-danger">*</span></label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <select class="form-select form-control" name="role"
                                        aria-label="Default select example" required>
                                        <option selected>--Select Role--</option>
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
                                    <input type="password" class="form-control form-control-sm" inputmode="text"
                                        placeholder="Password" id="password" name="password" required>
                                </div>
                                <!-- /.input group -->

                            </div>
                            <!-- /.form group -->

                            <div class="form-group row">
                                <div class="col-md-11">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="checkbox" onclick="showPassword()"
                                                class="mt-2"> Show Password
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <!-- Status -->
                            <div class="form-group d-flex">
                                <label>Status: </label>

                                <div class="form-group clearfix mx-3">
                                    <div class="icheck-success d-inline">
                                        <input type="radio" name="status" value="0" checked="" id="radioSuccess1">
                                        <label for="radioSuccess1">Active</label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" name="status" value="1" id="radioSuccess2">
                                        <label for="radioSuccess2">Inactive</label>
                                    </div>
                                </div>

                            </div>
                            <!-- /.form group -->

                            <div class="">
                                <button class="btn btn-sm btn-success" type="submit" name="create_user">Create
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