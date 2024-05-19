<?php

require('../libraries/fpdf/fpdf.php');

class PDF extends FPDF {

    
    function Header() {

        $this->Image(ROOT. '/assets/images/cert2.png', 0, 0, 297, 210);


        $this->SetFont('Times', 'B', 28);
        $this->SetTextColor(128, 0, 0);
        $this->Cell(0, 20, $_SESSION['schoolname'], 0, 1, 'C');


        $this->SetFont('Times', 'B', 24);
        $this->SetTextColor(0, 0, 128); 
        $this->Cell(0, 20, 'Certificate of Completion', 0, 1, 'C');
        

        $this->Ln(10);
    }

    function Footer() {
        
        $this->SetY(-15);
        $this->SetFont('Times', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

}

$pdf = new PDF('L');
$pdf->AddPage();

$pdf->SetFillColor(255, 255, 204);

$pdf->SetDrawColor(255, 204, 102);
$pdf->SetLineWidth(2);
$pdf->Rect(10, 10, 277, 190, 'D');


$studentName = $studentInfo->stud_fname . ' ' . $studentInfo->stud_lname;
$academicYear = $acads_default->academic_year;
$semester = 'Semester ' . $acads_default->semester;
$currentDate = date("F j, Y");
$introText = "This is to certify that";
$participationText = "has participated in the\nFaculty Evaluation\nfor Academic Year $academicYear, $semester\non $currentDate.";


$pdf->SetFont('Times', 'I', 22);
$pdf->SetTextColor(102, 51, 0);


$pdf->SetXY(10, 60); 
$pdf->MultiCell(0, 15, $introText, 0, 'C'); 


$pdf->SetFont('Times', 'B', 30);
$pdf->SetXY(10, 80); 
$pdf->MultiCell(0, 20, $studentName, 0, 'C'); 


$pdf->SetFont('Times', 'I', 22);
$pdf->SetXY(10, 110);
$pdf->MultiCell(0, 15, $participationText, 0, 'C');

$pdf->Output('I', $studentName . '.pdf'); // 'D' for download
?>
