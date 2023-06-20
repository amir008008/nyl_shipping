<?php

ob_start();
session_start();
include_once '../inc/header.php';
include_once '../dataAccess/connections.php';

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}


$get_info_id = $_GET['info_id'];
$shipper = NULL;
$get_foriegn_key = NULL;
$info_id = NULL;
$marks_and_nos_container_and_seals = NULL;
$number_of_containers = NULL;
$no_and_kind_of_packages = NULL;
$description = NULL;
$gross_weight_cargo = NULL;
$measurement = NULL;
$tare = NULL;

if (isset($_GET['info_id'])) {
    // getting the user information
    $q = "SELECT * FROM `information` WHERE id = '$get_info_id'";
    $query = mysqli_query($connection, $q);

    foreach ($query as $rows) {
        $shipper = $rows['shipper'];
        $consignee = $rows['consignee'];
        $notify_party = $rows['notify_party'];
        $voyage_number = $rows['voyage_number'];
        $pre_carriage_by = $rows['pre_carriage_by'];
        $vessel = $rows['vessel'];
        $freight_to_be_paid_at = $rows['freight_to_be_paid_at'];
        $port_of_discharge = $rows['port_of_discharge'];
        $bill_of_lading_number = $rows['bill_of_lading_number'];
        $place_of_receipt = $rows['place_of_receipt'];
        $port_of_loading = $rows['port_of_loading'];
        $number_of_original_bill_of_loding = $rows['number_of_original_bill_of_loding'];
        $final_place_of_delivery = $rows['final_place_of_delivery'];
        $date_of_issue = $rows['date_of_issue'];
        $get_foriegn_key = $rows['id'];
    }

    if (isset($_POST['update_bill'])) {
        $shipper  = mysqli_real_escape_string($connection, $_POST['shipper']);
        $consignee  = mysqli_real_escape_string($connection, $_POST['consignee']);
        $notify_party  = mysqli_real_escape_string($connection, $_POST['notify_party']);
        $voyage_number  = mysqli_real_escape_string($connection, $_POST['voyage_number']);
        $pre_carriage_by  = mysqli_real_escape_string($connection, $_POST['pre_carriage_by']);
        $vessel  = mysqli_real_escape_string($connection, $_POST['vessel']);
        $freight_to_be_paid_at  = mysqli_real_escape_string($connection, $_POST['freight_to_be_paid_at']);
        $port_of_discharge  = mysqli_real_escape_string($connection, $_POST['port_of_discharge']);
        $bill_of_lading_number  = mysqli_real_escape_string($connection, $_POST['bill_of_lading_number']);
        $place_of_receipt  = mysqli_real_escape_string($connection, $_POST['place_of_receipt']);
        $port_of_loading  = mysqli_real_escape_string($connection, $_POST['port_of_loading']);
        $number_of_original_bill_of_loding  = mysqli_real_escape_string($connection, $_POST['number_of_original_bill_of_loding']);
        $final_place_of_delivery  = mysqli_real_escape_string($connection, $_POST['final_place_of_delivery']);

        $query = "UPDATE `information` SET `shipper`= '" . $shipper . "',`consignee`= '" . $consignee . "',`notify_party`= '" . $notify_party . "',
                `voyage_number`= '" . $voyage_number . "', `pre_carriage_by`= '" . $pre_carriage_by . "', `vessel`= '" . $vessel .  "', `freight_to_be_paid_at`= '" . $freight_to_be_paid_at . "',
                `port_of_discharge`='" . $port_of_discharge .  "', `bill_of_lading_number`= '" . $bill_of_lading_number .  "', `place_of_receipt`='" . $place_of_receipt . "',
                `port_of_loading`='" . $port_of_loading .  "',`number_of_original_bill_of_loding`='" . $number_of_original_bill_of_loding . "',
                `final_place_of_delivery`='" . $final_place_of_delivery .  "', `date_of_issue`= '" . $date_of_issue .  "' WHERE id = '$get_info_id'";
        $run = mysqli_query($connection, $query);
    }
}

?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-title card-title bg-secondary p-3 text-white">
                        <div class="d-flex justify-content-between" onclick="billOfLading()">
                            <h4>Bill of Lading</h4>
                            <i class="fa-solid fa-caret-down container_dropdown" id="container_dropdown"></i>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="top_details" id="top_details">
                            <div class="row">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="shipper" class="col-sm-1 col-form-label">Shipper<span class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control form-control-sm" rows="5" name="shipper"><?php echo $shipper ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="consignee" class="col-sm-1 col-form-label">Consignee<span class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control form-control-sm" rows="5" name="consignee"><?php echo $consignee ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="notify_party" class="col-sm-1 col-form-label">Notify Party <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control form-control-sm" rows="5" name="notify_party"><?php echo $notify_party ?></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Voyage Number <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $voyage_number ?>" name="voyage_number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Pre Carriage By <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $pre_carriage_by ?>" name="pre_carriage_by">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Vessel<span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $vessel ?>" name="vessel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Freight to be paid at<span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $freight_to_be_paid_at ?>" name="freight_to_be_paid_at">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Port of Discharge<span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $port_of_discharge ?>" name="port_of_discharge">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bill of Lading Number <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $bill_of_lading_number ?>" name="bill_of_lading_number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Place of Receipt <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $place_of_receipt ?>" name="place_of_receipt">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Port of Loading <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $port_of_loading ?>" name="port_of_loading">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Number of Original Bills of
                                            Lading <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $number_of_original_bill_of_loding ?>" name="number_of_original_bill_of_loding">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Final Place of Delivery <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" value="<?= $final_place_of_delivery ?>" name="final_place_of_delivery" require_once>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-title bg-secondary p-3 text-white" onclick="containerHide()">
                            <div class="d-flex justify-content-between">
                                <h4>Container</h4>
                                <i class="fa-solid fa-caret-down container_dropdown" id="container_dropdown"></i>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="emptbl" class="table table-bordered table-hover">
                                <thead>
                                    <tr class="bg-secondary text-white">
                                        <th>ID</th>
                                        <th>Marks and NOS Container and Seals</th>
                                        <th>Number of Containers</th>
                                        <th>No and Kind of Packages</th>
                                        <th style="width: 400px">Description</th>
                                        <th>Gross Weight Cargo (KGS)</th>
                                        <th>Tare (KGS)</th>
                                        <th>Measurement (CBM)</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">

                                    <?php

                                    $container_q = "SELECT * FROM `container` WHERE info_id = '$get_info_id'";
                                    $run_container = mysqli_query($connection, $container_q);

                                    while ($row = mysqli_fetch_assoc($run_container)) {

                                        $info_id = $row['id'];
                                        if (isset($_POST['update_bill'])) {

                                            $marks_and_nos_container_and_seals  = mysqli_real_escape_string($connection, $_POST['marks_and_nos_container_and_seals']);
                                            $number_of_containers  = mysqli_real_escape_string($connection, $_POST['number_of_containers']);
                                            $no_and_kind_of_packages  = mysqli_real_escape_string($connection, $_POST['no_and_kind_of_packages']);
                                            $description  = mysqli_real_escape_string($connection, $_POST['description']);
                                            $gross_weight_cargo  = mysqli_real_escape_string($connection, $_POST['gross_weight_cargo']);
                                            $measurement = mysqli_real_escape_string($connection, $_POST['measurement']);
                                            $tare = mysqli_real_escape_string($connection, $_POST['tare']);

                                            $container_table_update = "UPDATE `container` SET `marks_and_nos_container_and_seals`='" . $marks_and_nos_container_and_seals . "', `number_of_containers`= '$number_of_containers',
                                                                            `no_and_kind_of_packages` = '$no_and_kind_of_packages', `description`= '" . $description . "', `gross_weight_cargo`= '$gross_weight_cargo',
                                                                            `measurement` = '$measurement', `tare`= '$tare' WHERE info_id = '$get_info_id' AND id = '$info_id'";
                                            $run_container_table = mysqli_query($connection, $container_table_update);
                                            if ($run_container_table) {
                                                header('Location: dashboard');
                                            } else {
                                                echo "<script>alert('Something wroth with updating part please contact Admin')</script>";
                                            }
                                        }

                                    ?>
                                    <tr>
                                        <td><?= $info_id ?></td>
                                        <td>
                                            <textarea name="marks_and_nos_container_and_seals" class="form-control" rows="2"><?= $row['marks_and_nos_container_and_seals'] ?></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="number_of_containers" class="form-control" value="<?= $row['number_of_containers'] ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="no_and_kind_of_packages" class="form-control" value="<?= $row['no_and_kind_of_packages'] ?>">
                                        </td>
                                        <td>
                                            <textarea name="description" class="form-control" rows="2"><?= $row['description'] ?></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="gross_weight_cargo" class="form-control" value="<?= $row['gross_weight_cargo'] ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="measurement" class="form-control" value="<?= $row['measurement'] ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="tare" class="form-control" value="<?= $row['tare'] ?>">
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Date of Issue <span class="text-danger mx-1">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" value="<?= $date_of_issue; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="update_bill" class="btn btn-sm btn-primary">
                            Update Bill
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once '../inc/footer.php';
