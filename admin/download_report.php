<?php
require_once(__DIR__ . '/fpdf/fpdf.php');
include("../conn.php");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Attendance Report',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(30,10,'ID',1);
$pdf->Cell(60,10,'Name',1);
$pdf->Cell(30,10,'Status',1);
$pdf->Cell(50,10,'Date',1);
$pdf->Ln();

$pdf->SetFont('Arial','',12);
$data = mysqli_query($conn, "SELECT sa.studentid, sa.name, a.status, a.date_recorded 
    FROM studentaccount sa 
    RIGHT JOIN attendance a ON sa.studentid = a.studentid 
    ORDER BY a.date_recorded");
while ($row = mysqli_fetch_assoc($data)) {
    $pdf->Cell(30,10,$row['studentid'],1);
    $pdf->Cell(60,10,$row['name'],1);
    $pdf->Cell(30,10,$row['status'],1);
    $pdf->Cell(50,10,date('F d, Y', strtotime($row['date_recorded'])),1);
    $pdf->Ln();
}
$pdf->Output('D', 'attendance_report.pdf');
exit();
?>
