<?php

session_start();
include_once '../inc/header.php';
require_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}


?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Users</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="create_users.php" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i>
                    Add Users</a>
            </div>
        </div>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Username</label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">User ID</label></label>
                    <input type="text" class="form-control floating">
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Usename</th>
                                <th>Role</th>
                                <th>Create By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = 1;
                            $query = "SELECT * FROM users ORDER BY id ASC";
                            $query_run = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($query_run)) {

                            ?>
                                <tr>
                                    <td><?= $i++; ?> </td>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td>
                                        <?php if ($row['role'] == '2') { ?>
                                            <span class="badge badge-warning p-1 px-2" style="color: black">Admin</span>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary p-1 px-2 text-white" style="color: black">Printer</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $row['created_by'] ?></td>
                                    <td>
                                        <?php if ($row['status'] == '0') { ?>
                                            <span class="custom-badge status-green">Active</span>
                                        <?php } else { ?>
                                            <span class="custom-badge status-grey">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td>

                                        <a href="view_users?user_id=<?php echo $row['id'] ?>">
                                            <i class="fas fa-eye text-primary mx-1"></i>
                                        </a>
                                        <a href="edit_user?user_id=<?php echo $row['id'] ?>">
                                            <i class="fa-solid fa-pen-to-square mx-1"></i>
                                        </a>
                                        <a href="delete_user?user_id=<?php echo $row['id'] ?>" onclick="return confirm('Make sure you want to delete this user')">
                                            <i class="fas fa-trash text-danger mx-1"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>

                    <div class="d-flex float-right">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once '../inc/footer.php';
