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
$pdf->Cell(35, 4, $date_of_date, 0, 1, 'L', true);

$pdf->Rect(0, 272.4, 105, 4.5, 'D'); 

$pdf->SetXY(0, 272.4); $pdf->SetFillColor(200, 200, 200); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(35, 4, "PLACE AND DATE OF ISSUE", 0, 1, 'L', true);

 

$pdf->SetXY(106, 268.4); $pdf->SetFillColor(255, 255, 255); $pdf->SetTextColor(0, 0, 0); $pdf->SetFont('Arial', '', 5);
$pdf->Cell(140, 6, "SIGNED FOR THE CARRIER CMA CGM S.A. ", 0, 1, 'L', true);

 

$image1 = "../assets/img/sign.jpeg";
$pdf->SetXY(155, 268.4); $pdf->Cell(0, 210, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 30));

 

$pdf->Output();