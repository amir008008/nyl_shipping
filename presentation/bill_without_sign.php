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
$pdf->AddPage();

// Shipper
// Left
$pdf->SetY(5);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// $pdf->Rect(0, 10, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true);

$pdf->SetY(10);
$pdf->SetX(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// // $pdf->Rect(0, 10, 105, 20, 'D'); //For A4
// // $pdf->Cell(105, 5, $shipper, 0, 1, 'L', true);
// if (strlen($shipper) > 50){
//    $article = substr_replace($shipper,"\n",50,0);         
// }
$pdf->MultiCell(105,4,($shipper),'1','',0);

// Right
$pdf->SetY(8);
$pdf->SetX(122);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(100, 10, 'ORIGINAL', 0, 1, 'L', true);

$pdf->SetY(16);
$pdf->SetX(113);
$pdf->SetFont('Arial', 'B', 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(105, 10, 'BILL OF LADING!', 0, 1, 'L', true);

$pdf->SetY(5);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Rect(165, 5, 105, 15, 'D'); //For A4
$pdf->Cell(165, 5, "VOYAGE NUMBER", 0, 1, 'L', true);

$pdf->SetY(11);
$pdf->SetX(175);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(170, 5, $voyage_number, 0, 1, 'L', true);

$pdf->SetY(18);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Rect(165, 18, 105, 12, 'D'); //For A4
$pdf->Cell(165, 5, "BILL OF LADING", 0, 1, 'L', true);

$pdf->SetY(24);
$pdf->SetX(175);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(170, 5, $bill_of_lading_number, 0, 1, 'L', true);

// Shipper INFO
// Consignee
// Left
$pdf->SetY(34);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// $pdf->Rect(0, 31, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Consignee", 0, 1, 'L', true);

$pdf->SetY(39);
$pdf->SetX(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// $pdf->Rect(0, 31, 105, 20, 'D'); //For A4
$pdf->MultiCell(105,4,($consignee),'1','',0);


// Right
$pdf->SetY(34);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(105, 5, "Export References", 0, 1, 'L', true);

// Company Details
// Company Logo
$image1 = "../assets/img/Image2.png";
$pdf->SetY(45);
$pdf->SetX(140);
$pdf->Cell(0, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'C', false );

$pdf->SetY(65);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(105, 5, "CARRIER: CMA CGM Société Anonyme au Capital de 234 988 330 Euros", 0, 1, 'C', true);

$pdf->SetY(70);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "Head Office: 4, quai d'Arenc - 13002 Marseille - France", 0, 1, 'C', true);

$pdf->SetY(75);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "Tel: (33) 4 88 91 90 00 - Fax: (33) 4 88 91 90 95", 0, 1, 'C', true);

$pdf->SetY(75);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(105, 5, "T562 024 422 R.C.S. Marseille", 0, 1, 'C', true);

// Notify Party
$pdf->SetY(63);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// $pdf->Rect(0, 55, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Notify Party", 0, 1, 'L', true);

$pdf->SetY(68);
$pdf->SetX(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
// $pdf->Rect(0, 31, 105, 20, 'D'); //For A4
$pdf->MultiCell(105,4,($consignee),'1','',0);

// Top

$pdf->SetY(92);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(52.5, 6, "PRE CARRIAGE BY *", 0, 1, 'C', true);

$pdf->SetY(92);
$pdf->SetX(52.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(52.5, 6, "PLACE OF RECEIPT*", 0, 1, 'C', true);

$pdf->SetY(92);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(50.5, 6, "FREIGHT TO BE PAID AT", 0, 1, 'C', true);

$pdf->SetY(92);
$pdf->SetX(155.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(57.5, 6, "NUMBER OF ORIGINAL BILLS OF LADING", 0, 1, 'C', true);

$pdf->SetY(98);
$pdf->SetX(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(0, 98, 52.5, 13, 'D'); //For A4
$pdf->Cell(52.5, 6, $pre_carriage_by, 0, 1, 'C', true);

$pdf->SetY(98);
$pdf->SetX(52.5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(52.5, 98, 52.5, 13, 'D'); //For A4
$pdf->Cell(52.5, 6, $place_of_receipt, 0, 1, 'C', true);

$pdf->SetY(98);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(105, 98, 50.5, 13, 'D'); //For A4
$pdf->Cell(50, 6, $freight_to_be_paid_at, 0, 1, 'C', true);

$pdf->SetY(98);
$pdf->SetX(155.5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(155.5, 98, 57.5, 13, 'D'); //For A4
$pdf->Cell(57.5, 6, $number_of_original_bill_of_loding, 0, 1, 'C', true);
 
// Bottom

$pdf->SetY(105);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(52.5, 6, "VESSEL", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(52.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(52.5, 6, "PORT OF LOADING", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(50.5, 6, "PORT OF DISCHARGE", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(155.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(57.5, 6, "FINAL PLACE OF DELIVERY*", 0, 1, 'C', true);

$pdf->SetY(110);
$pdf->SetX(0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(0, 110, 52.5, 7, 'D'); //For A4
$pdf->Cell(52.5, 6, $vessel, 0, 1, 'C', true);

$pdf->SetY(110);
$pdf->SetX(52.5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(52.5, 110, 52.5, 7, 'D'); //For A4
$pdf->Cell(52.5, 6, $port_of_loading, 0, 1, 'C', true);

$pdf->SetY(110);
$pdf->SetX(105);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(105, 110, 50.5, 7, 'D'); //For A4
$pdf->Cell(50, 6, $port_of_discharge, 0, 1, 'C', true);

$pdf->SetY(110);
$pdf->SetX(155.5);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(155.5, 110, 57.5, 7, 'D'); //For A4
$pdf->Cell(57.5, 6, $final_place_of_delivery, 0, 1, 'C', true);
 
// Description Table 

$pdf->SetY(169);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(210, 6, "ADDITIONAL CLAUSES", 0, 1, 'C', true);

$pdf->Rect(0, 175.1, 105, 61, 'D'); //For A4

$pdf->SetY(175.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "1. We are Third Party Between Shipper (Suppliers) / Consignee / Container Shipping line Carrier  ", 0, 1, 'L', true);

$pdf->SetY(179.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "2. Cranes Costs For Receiver's account.", 0, 1, 'L', true);

$pdf->SetY(183.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "3. Cargo at Port Is at Merchant Risk, Expenses & Responsibility.", 0, 1, 'L', true);

$pdf->SetY(187.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "4. FCL", 0, 1, 'L', true);

$pdf->SetY(191.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "5. All Costs of Discharging / Loading Operations & all Expenses From Free Out Full Container to Return Empty ", 0, 1, 'L', true);

$pdf->SetY(195.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "On Board Vessel Including Landing Charges, Ground Rent / Storage, Shore Cranes or Floating Cranes Effected", 0, 1, 'L', true);

$pdf->SetY(199.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "By Ship's Orders are Totally at Receiver's Risks & Expenses in Straight Time, Overtime, Fridays Saturday, ", 0, 1, 'L', true);

$pdf->SetY(203.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "Holidays & After Midnight Included.", 0, 1, 'L', true);

$pdf->SetY(207.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "6. Whenever Receivers do Not Take Delivery of Cargo after 120 days From Discharging Date the Shipper is", 0, 1, 'L', true);

$pdf->SetY(211.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "Responsible Towards the Line For all Expenses / Charges / Fees / Freights and Demurrages That May be", 0, 1, 'L', true);

$pdf->SetY(215.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "Incurred For Return Cargo to the Port OF Loading.", 0, 1, 'L', true);

$pdf->SetY(219.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "7. Devanning at Final Destination at Receiver's Risks and Expenses, to be effected within 10 Hours from ", 0, 1, 'L', true);

$pdf->SetY(223.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "8Date of Arrival of Trailer. Thereafter Demurrage Will is US$ 140 per 20' and US$ 280 per 40' per Day to be ", 0, 1, 'L', true);

$pdf->SetY(227.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "Collected From Receivers Otherwise Payable Upon Presentation of Adequate Waybill By Shipper.", 0, 1, 'L', true);

$pdf->SetY(231.2);
$pdf->SetX(1);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 5.8);
$pdf->Cell(105, 6, "8 Free Out", 0, 1, 'L', true);

$pdf->Rect(105, 175.1, 105, 61, 'D'); //For A4
$pdf->Rect(0, 236, 210, 45, 'D'); //For A4

$pdf->Rect(105, 281, 105, 40, 'D'); //For A4

// $column_completed = "";
// $column_engineer = "";
// $max_per_page = 2;
// $counter_rec = 0;


// Shipper
$pdf->SetY(300);
$pdf->SetX(0);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(0, 5, "", 0, 1);


// Right
$pdf->SetY(8);
$pdf->SetX(122);
$pdf->SetFont('Arial', 'B', 15);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(100, 10, 'ORIGINAL', 0, 1, 'L', true);

$pdf->SetY(16);
$pdf->SetX(113);
$pdf->SetFont('Arial', 'B', 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(105, 10, 'BILL OF LADING!', 0, 1, 'L', true);

$pdf->SetY(5);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(165, 5, "VOYAGE NUMBER", 0, 1, 'L', true);

$pdf->SetY(12);
$pdf->SetX(170);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(170, 5, "0MEBDW1MA", 0, 1, 'L', true);

$pdf->SetY(18);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(165, 5, "BILL OF LADING", 0, 1, 'L', true);

$pdf->SetY(25);
$pdf->SetX(170);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(170, 5, "SEL1322485", 0, 1, 'L', true);

$pdf->SetY(35);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "MARKS AND NOS", 0, 1, 'C', true);

$pdf->SetY(35);
$pdf->SetX(25);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "NO AND KIND", 0, 1, 'C', true);

$pdf->SetY(35);
$pdf->SetX(50);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(95, 6, "DESCRIPTION", 0, 1, 'C', true);

$pdf->SetY(35);
$pdf->SetX(145);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 6, "GROSS WEIGHT", 0, 1, 'C', true);

$pdf->SetY(35);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 6, "TARE", 0, 1, 'C', true);

$pdf->SetY(35);
$pdf->SetX(185);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "MEASUREMENT", 0, 1, 'C', true);

// $pdf->Rect(0, 105, 210, 90, 'D'); //For A4

$pdf->SetY(195);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(210, 6, "ADDITIONAL CLAUSES", 0, 1, 'C', true);

$pdf->Rect(0, 201, 105, 40, 'D'); //For A4
$pdf->Rect(105, 201, 105, 40, 'D'); //For A4
$pdf->Rect(0, 241, 210, 40, 'D'); //For A4

$pdf->Rect(105, 281, 105, 40, 'D'); //For A4

$pdf->Output();