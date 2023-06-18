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
}


?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="p-3 text-capitalize"><?= $name ?></h3>
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
                                    <input type="text" class="form-control form-control-sm" value="<?= $name ?>" name="name">
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
                                    <input type="text" class="form-control form-control-sm" inputmode="text" value="<?= $email ?>" name="email">
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
                                    <input type="text" class="form-control form-control-sm" inputmode="text" value="<?= $username ?>" name="username">
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
                                        <option value="<?php echo $role ?>">
                                            <?= $role == '2' ? "Admin" : "Printer" ?>
                                        </option>
                                    </select>
                                </div>

                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- Status -->
                            <div class="form-group d-flex">
                                <label>Status:</label>

                                <?php if ($status == '0') { ?>
                                    <div class="form-group clearfix mx-3">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" name="status" value="0" checked="checked" id="radioSuccess1" disabled>
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


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../inc/footer.php';
