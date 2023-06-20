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
    $date_of_date = $row['date_of_issue'];
}

$pdf = new FPDF(); 
$pdf->addPage("P", "A4");

$pdf->GetPageWidth();   
$pdf->GetPageHeight();  

/*
-- Left Side Container
// Shipper Details

*/
$pdf->SetXY(0, 0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true);
$pdf->Rect(0, 0, 105, 21, 'D');

$pdf->SetXY(0, 6);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 6);

$lineHeight = 1.6;
$textLines = explode("\n", $shipper);

$pdf->SetX(10); // Set X position with an indent

foreach ($textLines as $index => $line) {
    if ($index === 0) {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false, '', 10);
    } else {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false);
    }
    $pdf->SetX(0);
    $pdf->SetY($pdf->GetY() + $lineHeight);
}

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

$pdf->SetXY(0, 21);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(105, 5, "Consignee", 0, 1, 'L', true);
$pdf->Rect(0, 21, 105, 21, 'D');

$pdf->SetXY(0, 27);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 6);

$lineHeight = 1.6;
$textLines = explode("\n", $consignee);

$pdf->SetX(10); // Set X position with an indent

foreach ($textLines as $index => $line) {
    if ($index === 0) {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false, '', 10);
    } else {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false);
    }
    $pdf->SetX(0);
    $pdf->SetY($pdf->GetY() + $lineHeight);
}


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

$pdf->SetXY(0, 42);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(105, 5, "Notify Party", 0, 1, 'L', true);
$pdf->Rect(0, 42, 105, 21, 'D');

$pdf->SetXY(0, 48);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 6);

$lineHeight = 1.6; // Adjust line height as desired
$textLines = explode("\n", $notify_party);

$pdf->SetX(10); // Set X position with an indent

foreach ($textLines as $index => $line) {
    if ($index === 0) {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false, '', 10); // Apply indent only for the first line
    } else {
        $pdf->Cell(105, $lineHeight, $line, 0, 1, 'L', false);
    }
    $pdf->SetX(0);
    $pdf->SetY($pdf->GetY() + $lineHeight);
}

/*

Shipping Data Summery
Top Side

*/

$pdf->SetXY(0, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PRE CARRIAGE BY *", 0, 1, 'C', true); $pdf->Rect(0, 63, 52.5, 15, 'D'); 
$pdf->SetXY(52.5, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PLACE OF RECEIPT*", 0, 1, 'C', true); $pdf->Rect(52.5, 63, 52.5, 15, 'D'); 
$pdf->SetXY(105, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "FREIGHT TO BE PAID AT", 0, 1, 'C', true); $pdf->Rect(105, 63, 50.5, 15, 'D');
$pdf->SetXY(155.5, 63); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "NUMBER OF ORIGINAL BILLS OF LADING", 0, 1, 'C', true); $pdf->Rect(155.5, 63, 55.5, 15, 'D');

$pdf->SetXY(1, 69); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $pre_carriage_by, 0, 1, 'C', true);
$pdf->SetXY(53.5, 69); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $place_of_receipt, 0, 1, 'C', true); 
$pdf->SetXY(106, 69); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $freight_to_be_paid_at, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 69); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $number_of_original_bill_of_loding, 0, 1, 'C', true);
/*

Shipping Data Summery
Bottom Side

*/

$pdf->SetXY(0, 75); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "VESSEL", 0, 1, 'C', true); $pdf->Rect(0, 75, 52.5, 12.5, 'D'); 
$pdf->SetXY(52.5, 75); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PORT OF LOADING", 0, 1, 'C', true); $pdf->Rect(52.5, 75, 52.5, 12.5, 'D'); 
$pdf->SetXY(105, 75); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "PORT OF DISCHARGE", 0, 1, 'C', true); $pdf->Rect(105, 75, 50.5, 12.5, 'D');
$pdf->SetXY(155.5, 75); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "FINAL PLACE OF DELIVERY*", 0, 1, 'C', true); $pdf->Rect(155.5, 75, 55.5, 12.5, 'D');

$pdf->SetXY(1, 81); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $vessel, 0, 1, 'C', true);
$pdf->SetXY(53.5, 81); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_loading, 0, 1, 'C', true); 
$pdf->SetXY(106, 81); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_discharge, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 81); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $final_place_of_delivery, 0, 1, 'C', true);

/*
Table 
*/

$pdf->SetXY(10, 93); // Adjust the X position for the header

// Header starts ///
$pdf->SetXY(0, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(25, 6, 'MARKS AND NOS', 1, 'C');

$pdf->SetXY(25, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(30, 6, 'NO OF PACKAGES', 1, 'C');

$pdf->SetXY(55, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(75, 6, 'DESCRIPTION', 1, 'L');

$pdf->SetXY(130, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(30, 6, 'CARGO WEIGHT', 1, 'C');
$pdf->SetXY(130, 93.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 4, 'KGS', 0, 1, 'C');

$pdf->SetXY(160, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(20, 6, 'TARE', 1, 'C');
$pdf->SetXY(160, 93.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 4, 'KGS', 0, 1, 'C');

$pdf->SetXY(180, 87.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->MultiCell(30, 6, 'MEASUREMENT', 1, 'C');
$pdf->SetXY(180, 93.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 4, 'CBM', 0, 1, 'C');

//// header is over ///////
$query = "SELECT * FROM container WHERE container.info_id = '$get_info_id' LIMIT 8";
$run_d = mysqli_query($connection, $query);

$y = 95; // Adjust the initial Y position for rows

while ($x = mysqli_fetch_assoc($run_d)) {
    $remainingArea = $pdf->GetPageHeight() - $y;
    
    if ($remainingArea < 6) {
        $pdf->AddPage();
        $y = 90; // Reset the Y position for the new page
    }
    
    $pdf->SetXY(0, $y); // Adjust the X and Y positions for each cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(25, 6 , $x['marks_and_nos_container_and_seals'], 0, 'C');

    $pdf->SetXY(25, $y); // Adjust the X and Y positions for each cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(30, 6, $x['no_and_kind_of_packages'], 0, 'R');

    $pdf->SetXY(55, $y); // Adjust the X and Y positions for each cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(75, 6 , $x['description'], 0, 'L');
    

    $pdf->SetXY(130, $y); // Adjust the X and Y positions for each cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(30, 6, $x['gross_weight_cargo'], 0, 'C');

    $pdf->SetXY(160, $y); // Adjust the X and Y positions for each cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(20, 6, $x['tare'], 0, 'C');

    $pdf->SetXY(180, $y); // Adjusted X and Y positions to align the last cell
    $pdf->SetFillColor(200, 200, 200);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 6);
    $pdf->MultiCell(30, 6, $x['measurement'], 0, 'C');

    $y += 6; // Increase the Y position for the next row
}

if ($y >= $pdf->GetPageHeight()) {
    $pdf->AddPage();
    $y = 90; // Reset the Y position for the new page
}


/*

ADDITIONAL CLAUSES

*/

$pdf->SetXY(0, 165); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(210, 6, "ADDITIONAL CLAUSES", 0, 1, 'C', true); $pdf->Rect(0, 165, 210, 6, 'D'); 

// Texts

/*

LEFT SIDE DETAILS

*/

$pdf->SetXY(1, 171.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "1. We are Third Party Between Shipper (Suppliers) / Consignee / Container Shipping line Carrier  ", 0, 1, 'L', true);

$pdf->SetXY(1,175.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "2. Cranes Costs For Receiver's account.", 0, 1, 'L', true);

$pdf->SetXY(1, 179.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "3. Cargo at Port Is at Merchant Risk, Expenses & Responsibility.", 0, 1, 'L', true);

$pdf->SetXY(1, 183.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "4. FCL", 0, 1, 'L', true);

$pdf->SetXY(1, 187.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "5. All Costs of Discharging / Loading Operations & all Expenses From Free Out Full Container to Return Empty On Board Vessel ", 0, 1, 'L', true);

$pdf->SetXY(1, 191.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Including Landing Charges, Ground Rent / Storage, Shore Cranes or Floating Cranes Effected By Ship's Orders are Totally at ", 0, 1, 'L', true);

$pdf->SetXY(1, 195.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Receiver's Risks & Expenses in Straight Time, Overtime, Fridays Saturday, Holidays & After Midnight Included.", 0, 1, 'L', true);

$pdf->SetXY(1, 199.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "6. Whenever Receivers do Not Take Delivery of Cargo after 120 days From Discharging Date the Shipper is Responsible Towards ", 0, 1, 'L', true);

$pdf->SetXY(1, 203.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Line For all Expenses / Charges / Fees / Freights and Demurrages That May be Incurred For Return Cargo to the Port OF Loading.", 0, 1, 'L', true);

$pdf->SetXY(1, 207.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "7. Devanning at Final Destination at Receiver's Risks and Expenses, to be effected within 10 Hours from ", 0, 1, 'L', true);

$pdf->SetXY(1, 211.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "8. Date of Arrival of Trailer. Thereafter Demurrage Will is US$ 140 per 20' and US$ 280 per 40' per Day to be Collected From  ", 0, 1, 'L', true);

$pdf->SetXY(1, 215.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Receivers Otherwise Payable Upon Presentation of Adequate Waybill By Shipper.", 0, 1, 'L', true);

$pdf->SetXY(1, 219.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "8 Free Out", 0, 1, 'L', true);

$pdf->Rect(0, 171.3, 105, 57, 'D'); 

/*

RIGHT SIDE DETAILS

*/

$pdf->SetXY(106, 171.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "9. THC at Destination Payable by Merchant as per NYL Line / Port Tariff", 0, 1, 'L', true);

$pdf->SetXY(106, 175.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "10. Reloading Empty Containers to Remain For Receiver's Account at any Port of Discharge in Egypt.", 0, 1, 'L', true);

$pdf->SetXY(106, 179.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "11. Off-loading of Containers Full from Truck and Reloading of Empty onto Truck at Any Port In Egypt to be at ", 0, 1, 'L', true);

$pdf->SetXY(106, 183.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Receiver's Risk and Expenses.", 0, 1, 'L', true);

$pdf->SetXY(106, 187.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "12. On Top of the Free Out Expenses, Loading / Discharging Containers Full to / From Truck are at Receiver's ", 0, 1, 'L', true);

$pdf->SetXY(106, 191.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Risks and Expenses.", 0, 1, 'L', true);

$pdf->SetXY(106, 195.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "13. Mis-Declaration of Cargo Weight Endangers Crew, Port Workers and Vessel's Safety.", 0, 1, 'L', true);

$pdf->SetXY(106, 199.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "14. Demurrage and Detention Shall be Calculated & Paid as per General Tariff Available n the Web Site www.nylshipping.com ,", 0, 1, 'L', true);

$pdf->SetXY(106, 203.2); $pdf->SetX(106); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Or in Any of NYL Agency. However if Special Free Time onditions are Granted, Then Rates Applicable Conditions are Granted, ", 0, 1, 'L', true);

$pdf->SetXY(106, 207.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Then Rates Applicable as per General Tariff Grid Shall Start from the Day Following the Last Free Day.", 0, 1, 'L', true);

$pdf->SetXY(106, 211.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "15. The Authorized Agent of Our Line Shipping Is HEPTAGON TRADE COMPANY LIMITED in Middle East", 0, 1, 'L', true);

$pdf->SetXY(106, 215.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, " , Certificate No.: 72857661-000-04-23-1 , Website www.Heptagon-hk.com", 0, 1, 'L', true);

$pdf->SetXY(106, 219.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0);  $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "The Authorized Third Party Agent As Notify Party In Egypt To Collect Sea Freight Charge Is", 0, 1, 'L', true);

$pdf->SetXY(106, 223.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "TATOO FRIGHT-COMPANY OF AHMED ABDEL RAZIK NASR ABDEL MAKSOUD AND HIS PARTNER.", 0, 1, 'L', true);

$pdf->Rect(105, 171.3, 105, 57, 'D'); 

/*

Term and Conditions

*/

$pdf->SetXY(0, 228.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "RECEIVED by the Carrier From The Shipper in Apparent Good Order & Condition (Unless Otherwise Noted Herein) the Total Number or Quantity of Containers or Other Packages or Units Indicated Above Stated by the", 0, 1, 'L', true);

$pdf->SetXY(0, 232.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "Shipper Comprise The Cargo Specified Above For Transportation Subject to all the Terms Hereof (Including The Terms On Page One) From the Place of Receipt Or the Port of Loading. Whichever is Applicable, To ", 0, 1, 'L', true);

$pdf->SetXY(0, 236.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "the Port of Discharge  or the Place of Delivery, Whichever is applicable. Delivery of the Goods Will Only be Made on Payment of All Freight & Charges. On Presentation of this Document Duly endorsed) to the ", 0, 1, 'L', true);

$pdf->SetXY(0, 240.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "Carrier, by or on Behalf of the Holder,  the Rights and Liabilities Arising in Accordance With the Terms Hereof Shall (Without Prejudice to any Rule of Common Law or Statutes Rendering Them Binding Upon the ", 0, 1, 'L', true);

$pdf->SetXY(0, 244.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "Shipper, Holder and Carrier) Become Binding in all Respects Between the Carrier and Holder as Though the Contract Contained Herein or Evidenced Hereby Had been Made Between Them.", 0, 1, 'L', true);

$pdf->SetXY(0, 248.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "All Claims and Actions Arising Between the Carrier and the Merchant in Relation with the Contract of Carriage Evidenced by this Bill of Lading Shall Exclusively be Brought Before the Tribunal de Commerce de Hong Kong ", 0, 1, 'L', true);

$pdf->SetXY(0, 252.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "and no other Court Shall have Jurisdiction with Regards to any Such Claim or Action. Notwithstanding the above, the Carrier is also Entitled to Bring the Claim or Action Before the Court of the Place Where the ", 0, 1, 'L', true);

$pdf->SetXY(0, 256.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "Defendant has his Registered Office.", 0, 1, 'L', true);

$pdf->SetXY(0, 256.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6);
$pdf->Cell(210, 6, "In Witness Whereof Three (3) Original Bills of Lading, Unless Otherwise Stated above, have been Issued, one of which Being Accomplished, the others to be Void.", 0, 1, 'L', true);

$pdf->SetXY(0, 262.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 6);
$pdf->Cell(210, 6, "(OTHER TERMS AND CONDITIONS OF THE CONTRACT ON PAGE ONE)", 0, 1, 'C', true);

$pdf->Rect(0, 228.3, 210, 40, 'D'); 

/* 
Footer in First PDF
*/

$pdf->SetXY(0, 268.4); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(35, 4, "PLACE AND DATE OF ISSUE", 0, 1, 'L', true);

$pdf->SetXY(35, 268.4); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(35, 4, $place_of_receipt, 0, 1, 'L', true);

$pdf->SetXY(70, 268.4); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(35, 4, strtotime($date_of_date), 0, 1, 'L', true);


 
// Company Logo

// Shipper

// Company Logo
$image1 = "../assets/img/Image2.png";
$pdf->SetXY(0,280);
// $pdf->SetX(0);
$pdf->Cell(0, 0, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 35), 0, 0, 'C', false);

 
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

Shipping Data Summery
Top Side

*/

$pdf->SetXY(0, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PRE CARRIAGE BY *", 0, 1, 'C', true); $pdf->Rect(0, 21, 52.5, 15, 'D'); 
$pdf->SetXY(52.5, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PLACE OF RECEIPT*", 0, 1, 'C', true); $pdf->Rect(52.5, 21, 52.5, 15, 'D'); 
$pdf->SetXY(105, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "FREIGHT TO BE PAID AT", 0, 1, 'C', true); $pdf->Rect(105, 21, 50.5, 15, 'D');
$pdf->SetXY(155.5, 21); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "NUMBER OF ORIGINAL BILLS OF LADING", 0, 1, 'C', true); $pdf->Rect(155.5, 21, 55.5, 15, 'D');

$pdf->SetXY(1, 27); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $pre_carriage_by, 0, 1, 'C', true);
$pdf->SetXY(53.5, 27); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $place_of_receipt, 0, 1, 'C', true); 
$pdf->SetXY(106, 27); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $freight_to_be_paid_at, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 27); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $number_of_original_bill_of_loding, 0, 1, 'C', true);
/*

Shipping Data Summery
Bottom Side

*/

$pdf->SetXY(0, 32); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "VESSEL", 0, 1, 'C', true); $pdf->Rect(0, 32, 52.5, 15, 'D'); 
$pdf->SetXY(52.5, 32); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(52.5, 6, "PORT OF LOADING", 0, 1, 'C', true); $pdf->Rect(52.5, 32, 52.5, 15, 'D'); 
$pdf->SetXY(105, 32); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(50.5, 6, "PORT OF DISCHARGE", 0, 1, 'C', true); $pdf->Rect(105, 32, 50.5, 15, 'D');
$pdf->SetXY(155.5, 32); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 7); $pdf->Cell(57.5, 6, "FINAL PLACE OF DELIVERY*", 0, 1, 'C', true); $pdf->Rect(155.5, 32, 55.5, 15, 'D');

$pdf->SetXY(1, 38.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $vessel, 0, 1, 'C', true);
$pdf->SetXY(53.5, 38.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_loading, 0, 1, 'C', true); 
$pdf->SetXY(106, 38.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(48.5, 6, $port_of_discharge, 0, 1, 'C', true); 
$pdf->SetXY(158.5, 38.5); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(50.5, 6, $final_place_of_delivery, 0, 1, 'C', true);

/*
Table 
*/

$pdf->SetXY(0, 47.1);
// $width_cell=array(10,10,10,10, 10, 10);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->SetXY(0, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(25, 6, 'MARKS AND NOS', 1, 1, 'C');

$pdf->SetXY(25, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(30, 6, 'NO OF PACKAGES', 1, 1, 'C');

$pdf->SetXY(55, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(75, 6, 'DESCRIPTION', 1, 1, 'C');

$pdf->SetXY(130, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(30, 6, 'CARGO WEIGHT', 1, 1, 'C');
$pdf->SetXY(130, 59.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 4, 'KGS', 0, 1, 'C');

$pdf->SetXY(160, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(20, 6, 'TARE', 1, 1, 'C');
$pdf->SetXY(160, 59.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 4, 'KGS', 0, 1, 'C');

$pdf->SetXY(180, 53.1);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(30, 6, 'MEASUREMENT', 1, 1, 'C');
$pdf->SetXY(180, 59.1);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(30, 4, 'CBM', 0, 1, 'C');


//// header is over ///////
$d_query = "SELECT * FROM container WHERE container.info_id = '$get_info_id'";
if($result = mysqli_query($connection, $d_query)){

    $rowCount = mysqli_num_rows($result);

    if($rowCount > 8){
        $run_d = mysqli_query($connection, $query);

        while($x = mysqli_fetch_assoc($run_d)){
            $pdf->SetX(0);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(25,6,$x['marks_and_nos_container_and_seals'], 0, 0,'C');
            $pdf->SetX(25);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(30,6,$x['no_and_kind_of_packages'], 0, 0,'C');
            $pdf->SetX(55);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(75,6,$x['description'], 0, 0,'C');
            $pdf->SetX(130);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(30,6,$x['gross_weight_cargo'], 0, 0,'C');
            $pdf->SetX(160);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(30,6,$x['tare'], 0, 0,'C');
            $pdf->SetX(180);$pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 6); $pdf->Cell(30,6,$x['measurement'], 0, 0,'C');
            $pdf->Ln();
        }
    }
}



/*

ADDITIONAL CLAUSES

*/

$pdf->SetXY(0, 200); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 7); $pdf->Cell(210, 6, "ADDITIONAL CLAUSES", 0, 1, 'C', true); $pdf->Rect(0, 200, 210, 6, 'D'); 

// Texts

/*

LEFT SIDE DETAILS

*/

$pdf->SetXY(1, 206.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "17. The Shipper Acknowledges that the Carrier may Carry the Goods Identified in this Bill of Lading on the Deck of any Vessel and", 0, 1, 'L', true);

$pdf->SetXY(1,210.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "in Taking Remittance of This Bill of Lading the Merchant (Including the Shipper, he Consignee and the Holder of the Bill of Lading,", 0, 1, 'L', true);

$pdf->SetXY(1, 214.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "as the Case may be) Confirms his Express Acceptance of all the Terms and Conditions of this Bill of Lading and Expressly Confirms", 0, 1, 'L', true);

$pdf->SetXY(1, 218.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "his Unconditional and Irrevocable Consent to the Possible Carriage of the Goods on the Deck of any Vessel.", 0, 1, 'L', true);

$pdf->SetXY(1, 222.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "18. The Merchant is Responsible for Returning any Empty Container, with Interior Clean, Free of any Dangerous Goods Placards, ", 0, 1, 'L', true);

$pdf->SetXY(1, 226.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Labels or Markings, at the Designated Place, and within 60 days Following to the Date of Release, Failing Which the Container ", 0, 1, 'L', true);

$pdf->SetXY(1, 230.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Shall be Construed as Lost. The Merchant Shall be Liable to Indemnify the Carrier for any Loss or Expense Whatsoever arising ", 0, 1, 'L', true);

$pdf->SetXY(1, 234.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "out of the ,Foregoing including but not Limited to Liquidate Damages Equivalent to the Sound Market Value  or the ", 0, 1, 'L', true);

$pdf->SetXY(1, 238.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Depreciated Value Due by the Carrier to a Container Lessor. The Carrier is Entitled to Collect a Deposit From The Merchant at ", 0, 1, 'L', true);

$pdf->SetXY(1, 242.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "the Time of Release of the   Container which Shall be Remitted as Security for Payment of any Sums due to the Carrier, n ", 0, 1, 'L', true);

$pdf->SetXY(1, 246.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Particular For Payment of all Detention and Demurrage and / or Container Indemnity as Referred Above.", 0, 1, 'L', true);

$pdf->SetXY(1, 250.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "19. The Merchant Warrants that the Particulars Relating to the Goods have Been Checked and that Such Particulars are Adequate ", 0, 1, 'L', true);

$pdf->SetXY(1, 254.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "and Correct. In Case of Failure of the Merchant to Comply with Such Warranty, the Carrier Shall be Entitled to Charge the ", 0, 1, 'L', true);

$pdf->SetXY(1, 255.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Merchant at any Time an Amount of USD 2,000 per Container or Goods (For non-Containerized Cargo) as Processing", 0, 1, 'L', true);

$pdf->Rect(0, 206.3, 105, 57, 'D'); 

/*

RIGHT SIDE DETAILS

*/

$pdf->SetXY(106, 206.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "and Administrative Fees. This Fee Shall also be Applicable in Case of Discrepancy Between the Verified Gross Mass (VGM) Sent ", 0, 1, 'L', true);

$pdf->SetXY(106, 210.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "to the Carrier, or the Weight Declared to the Carrier (for non-containerized cargo), and the Weight Declaredin his ", 0, 1, 'L', true);

$pdf->SetXY(106, 214.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Shipping Instruction or Otherwise Weighted During the Carriage. by the Shipper  in his Shipping Instruction or Otherwise ", 0, 1, 'L', true);

$pdf->SetXY(106, 218.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Weighted During the Carriage.", 0, 1, 'L', true);

$pdf->SetXY(106, 222.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Carrier Draw Merchant's Attention to the Fact that as per Egyptian New Customs Law No. 207 For the Year 2020, , Published in the", 0, 1, 'L', true);

$pdf->SetXY(106, 226.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Egyptian Official Gazette on Nov. 11, 2020, Cargo shall be Auctioned by Customs Without any Notice if Merchant Fails to ", 0, 1, 'L', true);

$pdf->SetXY(106, 230.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Take Delivery Within 1(one) Month From The Date of Discharge.", 0, 1, 'L', true);

$pdf->SetXY(106, 234.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "21. Seal, Weight, Number and Description of Goods as Declared by Shipper. Containers Delivered to Sea Carrier Loaded, Counted, ", 0, 1, 'L', true);

$pdf->SetXY(106, 238.2); $pdf->SetX(106); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Stowed, Locked and Sealed by Shipper.Carrier having no adequate means for Checking same and Ship having to Sail Immediately, ", 0, 1, 'L', true);

$pdf->SetXY(106, 242.2);  $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Carrier is not Responsible for any Missing / Excess in Number of Packages, Shortage / Excess in Weight of Contents and", 0, 1, 'L', true);

$pdf->SetXY(106, 246.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Discrepancy of the Goods and Seal as Declared by Shipper. Preliminary Customs Registration Number for Shipment Bound to ", 0, 1, 'L', true);

$pdf->SetXY(106, 250.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Egypt as Declared by shipper. Any Consequences of misdeclaration / Discrepancy at Shipper's Risks and Expenses.", 0, 1, 'L', true);

$pdf->SetXY(106, 254.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0);  $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "22. Merchant Consents to the Carrier Sharing Information and Data contained in the Bill of Lading And / Or Related to the ", 0, 1, 'L', true);

$pdf->SetXY(106, 258.2); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(105, 6, "Performance of the Carriage of the Goods with third Parties, Including but not Limited to Digital Supply Chain Platforms.", 0, 1, 'L', true);

$pdf->Rect(105, 206.3, 105, 57, 'D'); 

/*

*/

$pdf->Output();