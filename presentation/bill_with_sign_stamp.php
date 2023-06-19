<?php
require '../vendor/fpdf/fpdf.php';
require_once '../dataAccess/connections.php';

$get_info_id = $_GET['info_id'];
$shipper = NULL;
$consignee = NULL;
$notify_party = NULL;
$voyage_number = NULL;
$pre_carriage_by = NULL;
$vessel = NULL;
$freight_to_be_paid_at = NULL;
$port_of_discharge = NULL;
$bill_of_lading_number = NULL;
$place_of_receipt = NULL;
$port_of_loading = NULL;
$number_of_original_bill_of_loding = NULL;
$final_place_of_delivery = NULL;
$date_of_date = NULL;

$query = "SELECT * FROM information INNER JOIN container ON information.id = container.info_id WHERE information.id = '$get_info_id' AND container.info_id = '$get_info_id'";
$run = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($run)){

    $shipper = $row['shipper'];
    $consignee = $row['consignee'];
    $notify_party = $row['notify_party'];
    $voyage_number = $row['voyage_number'];
    $pre_carriage_by = $row['pre_carriage_by'];
    $vessel = $row['vessel'];
    $freight_to_be_paid_at = $row['freight_to_be_paid_at'];
    $port_of_discharge = $row['port_of_discharge'];
    $bill_of_lading_number = $row['bill_of_lading_number'];
    $place_of_receipt = $row['place_of_receipt'];
    $port_of_loading = $row['port_of_loading'];
    $number_of_original_bill_of_loding = $row['number_of_original_bill_of_loding'];
    $final_place_of_delivery = $row['final_place_of_delivery'];
    $date_of_date = $row['date_of_date'];
}

$pdf = new FPDF(); 
$pdf->addPage("P", "A4");

$pdf->GetPageWidth();   
$pdf->GetPageHeight();  

/*
-- Left Side Container
// Shipper Details

*/
$pdf->SetXY(0, 0); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true); $pdf->Rect(0, 0, 105, 21, 'D'); 
$pdf->SetXY(0, 5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 8); $pdf->MultiCell(105, 4,($shipper), 0);

// Right Side Container
// Title
$pdf->SetXY(121, 2); $pdf->SetFont('Arial', 'B', 15); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->Cell(100, 10, 'ORIGINAL', 0, 1, 'L', true);
$pdf->SetXY(113, 10); $pdf->SetFont('Arial', 'B', 0); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->Cell(105, 10, 'BILL OF LADING!', 0, 1, 'L', true); 
// Bill Details
$pdf->SetXY(165,0); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Rect(165, 0, 105, 11, 'D'); $pdf->Cell(165, 5, "VOYAGE NUMBER", 0, 1, 'L', true);
$pdf->SetXY(166, 6); $pdf->SetFillColor(0, 0, 0); $pdf->SetFillColor(255, 255, 255); $pdf->SetFont('Arial', '', 8); $pdf->Cell(170, 5, $voyage_number, 0, 1, 'L', true); 
$pdf->SetXY(165, 11); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Rect(165, 11, 105, 11, 'D'); $pdf->Cell(165, 5, "BILL OF LADING", 0, 1, 'L', true);
$pdf->SetXY(166, 16); $pdf->SetFillColor(0, 0, 0); $pdf->SetFillColor(255, 255, 255); $pdf->SetFont('Arial', '', 8); $pdf->Cell(170, 5, $bill_of_lading_number, 0, 1, 'L', true);

/*

// CONSIGNEE Details

*/

$pdf->SetXY(0, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true); $pdf->Rect(105, 21, 105, 42, 'D'); 
$pdf->SetXY(0, 26); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 8); $pdf->MultiCell(105, 4,($shipper), 0);

/*

// EXPORT REFERENCES => Right Side

*/

$pdf->SetXY(105, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true); $pdf->Rect(0, 21, 105, 21, 'D'); 

// Company Details
// Company Logo

$image1 = "../assets/img/Image2.png";
$pdf->SetXY(140, 28); $pdf->Cell(0, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30));

$pdf->SetXY(105, 45); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(105, 5, "CARRIER: CMA CGM Société Anonyme au Capital de 234 988 330 Euros", 0, 1, 'C', true);

$pdf->SetXY(140, 49); $pdf->SetX(105); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "Head Office: 4, quai d'Arenc - 13002 Marseille - France", 0, 1, 'C', true);

$pdf->SetXY(140, 53); $pdf->SetX(105); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "Tel: (33) 4 88 91 90 00 - Fax: (33) 4 88 91 90 95", 0, 1, 'C', true);

$pdf->SetXY(140, 57); $pdf->SetX(105); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "T562 024 422 R.C.S. Marseille", 0, 1, 'C', true);

/*

// Notify Party

*/

$pdf->SetXY(0, 42); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 8); $pdf->Cell(105, 5, "Notify Party", 0, 1, 'L', true); $pdf->Rect(0, 42, 105, 21, 'D'); 
$pdf->SetXY(0, 47); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 8); $pdf->MultiCell(105, 4,($notify_party), 0);

/*

Shipping Data Summery
Top Side

*/

$pdf->SetXY(0, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PRE CARRIAGE BY *", 0, 1, 'C', true); $pdf->Rect(0, 63, 52.5, 15, 'D'); 
$pdf->SetXY(52.5, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PLACE OF RECEIPT*", 0, 1, 'C', true); $pdf->Rect(52.5, 63, 52.5, 15, 'D'); 
$pdf->SetXY(105, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "FREIGHT TO BE PAID AT", 0, 1, 'C', true); $pdf->Rect(105, 63, 50.5, 15, 'D');
$pdf->SetXY(155.5, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "NUMBER OF ORIGINAL BILLS OF LADING", 0, 1, 'C', true); $pdf->Rect(155.5, 63, 55.5, 15, 'D');

$pdf->SetXY(1, 70); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $pre_carriage_by, 0, 1, 'C', true);
$pdf->SetXY(53.5, 70); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $place_of_receipt, 0, 1, 'C', true); 
$pdf->SetXY(106, 70); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $freight_to_be_paid_at, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 70); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $number_of_original_bill_of_loding, 0, 1, 'C', true);
/*

Shipping Data Summery
Bottom Side

*/

$pdf->SetXY(0, 78); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "VESSEL", 0, 1, 'C', true); $pdf->Rect(0, 78, 52.5, 15, 'D'); 
$pdf->SetXY(52.5, 78); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PORT OF LOADING", 0, 1, 'C', true); $pdf->Rect(52.5, 78, 52.5, 15, 'D'); 
$pdf->SetXY(105, 78); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "PORT OF DISCHARGE", 0, 1, 'C', true); $pdf->Rect(105, 78, 50.5, 15, 'D');
$pdf->SetXY(155.5, 78); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "FINAL PLACE OF DELIVERY*", 0, 1, 'C', true); $pdf->Rect(155.5, 78, 55.5, 15, 'D');

$pdf->SetXY(1, 86); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $vessel, 0, 1, 'C', true);
$pdf->SetXY(53.5, 86); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_loading, 0, 1, 'C', true); 
$pdf->SetXY(106, 86); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_discharge, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 86); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $final_place_of_delivery, 0, 1, 'C', true);

/*
Table 
*/

$pdf->SetXY(0, 93.2); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "VESSEL", 0, 1, 'C', true); 
$pdf->SetXY(52.5, 93.2); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PORT OF LOADING", 0, 1, 'C', true); 
$pdf->SetXY(105, 93.2); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "PORT OF DISCHARGE", 0, 1, 'C', true); 
$pdf->SetXY(155.5, 93.2); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "FINAL PLACE OF DELIVERY*", 0, 1, 'C', true);


/*

ADDITIONAL CLAUSES

*/

$pdf->SetXY(0, 180); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(210, 6, "ADDITIONAL CLAUSES", 0, 1, 'C', true); $pdf->Rect(0, 180, 210, 6, 'D'); 


$pdf->Output();