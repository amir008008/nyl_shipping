<?php

session_start();
include_once '../inc/header.php';
include_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}
$role = $_SESSION['role'];

?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Bill of Lading</h4>
            </div>
            <?php if($role == 2) { ?>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add_bill" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i>
                    Add Bill of Lading </a>
            </div>
            <?php } ?>
        </div>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label" id="myInput">Container Number</label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Bill Number</label></label>
                    <input type="text" class="form-control floating">
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <label class="focus-label">Voyege Number</label>
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
                                <th>Voyage Number</th>
                                <th>Bill of Lading No.</th>
                                <th>Issue Date</th>
                                <th>Place of Issue</th>
                                <th>Number of Containers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">

                            <?php

                            $q = "SELECT * FROM `container` INNER JOIN `information` ON container.info_id = information.id GROUP BY info_id ORDER BY information.created_time DESC";
                            $query = mysqli_query($connection, $q);

                            while ($row = mysqli_fetch_assoc($query)) {

                            ?>

                            <tr>
                                <td><?= $row['info_id'] ?></td>
                                <td><?= $row['voyage_number'] ?></td>
                                <td><?= $row['bill_of_lading_number'] ?></td>
                                <td><?= $row['date_of_issue'] ?></td>
                                <td><?= $row['port_of_discharge'] ?></td>
                                <td>
                                    <span class="custom-badge status-green"><?= $row['number_of_containers'] ?></span>
                                </td>
                                <td>
                                    <a href="view_bill?info_id=<?php echo $row['info_id'] ?>">
                                        <i class="fas fa-eye text-primary mx-1"></i>
                                    </a>
                                    <a href="">
                                        <a href="#" class="" data-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-print mx-1"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="bill_with_sign_stamp?info_id=<?php echo $row['info_id'] ?>"><i
                                                    class="fa fa-pencil m-r-5"></i> With
                                                Signature | Stamp </a>
                                            <a class="dropdown-item"
                                                href="bill_without_sign?info_id=<?php echo $row['info_id'] ?>"><i
                                                    class="fa fa-ban m-r-5"></i>
                                                Without Signature | Stamp</a>
                                        </div>
                                    </a>
                                    <?php if ($role == 2) { ?>
                                    <a href="edit_bill?info_id=<?php echo $row['info_id'] ?>">
                                        <i class="fa-solid fa-pen-to-square mx-1"></i>
                                    </a>

                                    <a href="delete_bill?info_id=<?php echo $row['info_id'] ?>"
                                        onclick="return confirm('Are you sure you want to delete bill of lading')">
                                        <i class="fas fa-trash text-danger mx-1"></i>
                                    </a>
                                    <?php } ?>
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

<?php include_once '../inc/footer.php'; ?>

<script>
$(document).ready(function() {
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>