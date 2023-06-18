<?php
require '../vendor/fpdf/fpdf.php';
require_once '../dataAccess/connections.php';

$get_info_id = $_GET['info_id'];

$pdf = new FPDF();
$pdf->AddPage();

// Shipper
// Left
$pdf->SetY(5);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Rect(0, 10, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Shipper", 0, 1, 'L', true);

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

// Shipper INFO
// Consignee
// Left
$pdf->SetY(30);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Rect(0, 31, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Consignee", 0, 1, 'L', true);

// Right
$pdf->SetY(30);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(105, 5, "Export References", 0, 1, 'L', true);

// Notify Party
$pdf->SetY(50);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Rect(0, 55, 105, 20, 'D'); //For A4
$pdf->Cell(105, 5, "Notify Party", 0, 1, 'L', true);


// Top

$pdf->SetY(75);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(0, 75, 52.5, 20, 'D'); //For A4
$pdf->Cell(52.5, 6, "Pre Carriage BY", 0, 1, 'C', true);

$pdf->SetY(75);
$pdf->SetX(52.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(52.5, 75, 52.5, 20, 'D'); //For A4
$pdf->Cell(52.5, 6, "Place of Receipt", 0, 1, 'C', true);

$pdf->SetY(75);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(105, 75, 52.5, 20, 'D'); //For A4
$pdf->Cell(52.5, 6, "Freight to be Paid", 0, 1, 'C', true);

$pdf->SetY(75);
$pdf->SetX(157.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(157.5, 75, 52.5, 20, 'D'); //For A4
$pdf->Cell(52.5, 6, "Number of Original Bills of Lading", 0, 1, 'C', true);

// Bottom

$pdf->SetY(90);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(0, 90, 52.5, 15, 'D'); //For A4
$pdf->Cell(52.5, 6, "Vessel", 0, 1, 'C', true);

$pdf->SetY(90);
$pdf->SetX(52.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(52.5, 90, 52.5, 15, 'D'); //For A4
$pdf->Cell(52.5, 6, "Port of Loading", 0, 1, 'C', true);

$pdf->SetY(90);
$pdf->SetX(105);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Rect(105, 90, 52.5, 15, 'D'); //For A4
$pdf->Cell(52.5, 6, "Port of Discharge", 0, 1, 'C', true);

$pdf->SetY(90);
$pdf->SetX(157.5);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(52.5, 6, "Final Place of Delivery", 0, 1, 'C', true);

// Description Table 

$pdf->SetY(105);
$pdf->SetX(0);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "MARKS AND NOS", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(25);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "NO AND KIND", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(50);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(95, 6, "DESCRIPTION", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(145);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 6, "GROSS WEIGHT", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(165);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 6, "TARE", 0, 1, 'C', true);

$pdf->SetY(105);
$pdf->SetX(185);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(25, 6, "MEASUREMENT", 0, 1, 'C', true);

$pdf->Rect(0, 105, 210, 90, 'D'); //For A4

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
