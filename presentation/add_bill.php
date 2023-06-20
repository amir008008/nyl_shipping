<?php

session_start();

// checking if a user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index');
}

$user_id = $_SESSION['user_id'];

include_once '../inc/header.php';
include_once '../dataAccess/connections.php';

$id_run = null;

if (isset($_POST['submit_bill'])) {
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
    $date_of_issue  = mysqli_real_escape_string($connection, $_POST['date_of_issue']);

    $query = "INSERT INTO `information`(`shipper`, `consignee`, `notify_party`, `voyage_number`, `pre_carriage_by`, `vessel`, `freight_to_be_paid_at`, `port_of_discharge`, `bill_of_lading_number`, 
                                    `place_of_receipt`, `port_of_loading`, `number_of_original_bill_of_loding`, `final_place_of_delivery`, `date_of_issue`, `created_by`, `created_time`) 
            VALUES('" . $shipper . "', '" . $consignee . "', '" . $notify_party . "', '" . $voyage_number . "', '" . $pre_carriage_by . "', '" . $vessel . "', '" . $freight_to_be_paid_at . "', 
                    '" . $port_of_discharge . "', '" . $bill_of_lading_number . "', '" . $place_of_receipt . "', '" . $port_of_loading . "', '" . $number_of_original_bill_of_loding . "', 
                    '" . $final_place_of_delivery . "', '" . $date_of_issue . "', '$user_id', NOW())";
    $query_run = mysqli_query($connection, $query);

    $lastId = mysqli_insert_id($connection);
    echo $lastId;

    for ($a = 0; $a < count($_POST["marks_and_nos_container_and_seals"]); $a++) {
        $sql = "INSERT INTO `container`(`info_id`, `marks_and_nos_container_and_seals`, `number_of_containers`, `no_and_kind_of_packages`, `description`, `gross_weight_cargo`, `measurement`, `tare`, `create_by`) 
                    VALUES ('$lastId', '" . $_POST["marks_and_nos_container_and_seals"][$a] . "', '" . $_POST["number_of_containers"][$a] . "', '" . $_POST["no_and_kind_of_packages"][$a] . "', 
                        '" . $_POST["description"][$a] . "', '" . $_POST["gross_weight_cargo"][$a] . "', '" . $_POST["measurement"][$a] . "', '" . $_POST["tare"][$a] . "', '" . $user_id . "')";
        echo $sql;
        $runner =  mysqli_query($connection, $sql);

        if ($runner) {
            header("Location: ./dashboard");
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
                                        <label for="shipper" class="col-sm-1 col-form-label">Shipper<span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea type="email" class="form-control" id="shipper" name="shipper"
                                                placeholder="Shipper Details" rows="3" required
                                                maxlength="5000"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="consignee" class="col-sm-1 col-form-label">Consignee<span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea type="email" class="form-control" id="consignee" name="consignee"
                                                placeholder="Consignee" rows="3" required maxlength="5000"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="notify_party" class="col-sm-1 col-form-label">Notify Party <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <textarea type="email" class="form-control" id="notify_party"
                                                placeholder="Notify Party" rows="3" name="notify_party" required
                                                maxlength="5000"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Voyage Number <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Voyage Number"
                                                name="voyage_number" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Pre Carriage By <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Pre Carriage By"
                                                name="pre_carriage_by" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Vessel<span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Vessel" name="vessel"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Freight to be paid at<span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Freight to be paid at"
                                                name="freight_to_be_paid_at" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Port of Discharge<span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Port of Discharge"
                                                name="port_of_discharge" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bill of Lading Number <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Bill of Lading Number"
                                                name="bill_of_lading_number" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Place of Receipt <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Place of Receipt"
                                                name="place_of_receipt" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Port of Loading <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" placeholder="Port of Loading"
                                                name="port_of_loading" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Number of Original Bills of
                                            Lading <span class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                placeholder="Number of Original Bills of Lading"
                                                name="number_of_original_bill_of_loding" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Final Place of Delivery <span
                                                class="mx-1 text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"
                                                placeholder="Final Place of Delivery" name="final_place_of_delivery"
                                                require_once>
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
                                <tr class="bg-secondary text-white">
                                    <thead>
                                        <th>#</th>
                                        <th>Marks and NOS Container and Seals</th>
                                        <!-- <th>Number of Containers</th> -->
                                        <th>No and Kind of Packages</th>
                                        <th style="width: 400px">Description</th>
                                        <th>Gross Weight Cargo</th>
                                        <th>Measurement</th>
                                        <th>Tare</th>
                                        <th>Action</th>
                                    </thead>
                                </tr>

                                <tbody id="tbody">

                                </tbody>
                            </table>
                        </div>

                        <table class="mb-3 mx-auto">
                            <tr class="">
                                <td>
                                    <input type="button" value="Add Container" onclick="addItem()"
                                        class="btn btn-sm btn-primary mx-2 text-white" />
                                </td>
                            </tr>
                        </table>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Date of Issue <span
                                            class="text-danger mx-1">*</span></label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="date_of_issue" required
                                            min="2023-05-09" max="2100-05-10">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" name="submit_bill" class="btn btn-primary">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var items = 0;

function addItem() {
    items++;

    var html = "<tr>";
    html += "<td>" + items + "</td>";
    html +=
        '<td><input type="text" name="marks_and_nos_container_and_seals[]" class="form-control form-control-sm" required />';
    // html +=
    //     '<td><input type="number" name="number_of_containers[]" class="form-control form-control-sm" required /></td>';
    html +=
        '<td> <input type="text" name="no_and_kind_of_packages[]" class="form-control form-control-sm" required /></td>';
    html += '<td> <input type="text" name="description[]" class="form-control form-control-sm" required /></td>';
    html += '<td><input type="text" name="gross_weight_cargo[]" class="form-control form-control-sm" required /></td>';
    html += '<td><input type="text" name="measurement[]" class="form-control form-control-sm" required /></td>';
    html += '<td> <input type="text" name="tare[]" class="form-control form-control-sm" required /></td>';
    html += "<td><button type='button' class='btn btn-sm btn-danger' onclick='deleteRow(this);'>Delete</button></td>"
    html += "</tr>";

    var row = document.getElementById("tbody").insertRow();
    row.innerHTML = html;
}

function deleteRow(button) {
    items--;
    button.parentElement.parentElement.remove();
    // first parentElement will be td and second will be tr.
}
</script>

<?php include_once '../inc/footer.php';