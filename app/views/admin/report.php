<?php
require('../libraries/fpdf/fpdf.php');


// Function to get evaluation data (similar to the one in your controller)
function getEvaluationData($faculty_id, $section_id, $academic_id) {
    $acadx = new Acad();
    $acads_default = $acadx->first(['ay_default' => 1]);

    $sectionx = new Section();
    $facultyx = new Faculty();
    $subjectx = new Subject();
    $studentx = new Student();
    $handlex = new Handling();
    $evaluationx = new Evaluation();
    $criterionx = new Criteria();
    $questionx = new Question();

    $facultyInfo = $facultyx->first(['id' => $faculty_id]);
    $handles = $handlex->where(['section_id' => $section_id, 'faculty_id' => $faculty_id]);
    $subjects = $subjectx->findAll();
    $sectionInfo = $sectionx->first(['id' => $section_id]);
    $criteria = $criterionx->findAllOrder('order_by', 'ASC');
    $questions = $questionx->findAll();
    $evaluationResults = $evaluationx->getEvaluationResultsBySectionAndFaculty($section_id, $faculty_id, $academic_id);

    $totalEvaluators = count($evaluationx->where(['class_id' => $section_id, 'faculty_id' => $faculty_id, 'academic_id' => $academic_id]));
    $totalStudent = count($studentx->where(['stud_class' => $section_id]));

    return [
        'facultyInfo' => $facultyInfo,
        'handles' => $handles,
        'subjects' => $subjects,
        'sectionInfo' => $sectionInfo,
        'totalEvaluators' => $totalEvaluators,
        'totalStudent' => $totalStudent,
        'criteria' => $criteria,
        'questions' => $questions,
        'evaluationResults' => $evaluationResults,
        
    ];
}

// Check for POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty_id = $_POST['faculty_id'] ?? null;
    $section_id = $_POST['section_id'] ?? null;
    $academic_id = $_POST['academic_id'] ?? null;

    if (!$faculty_id || !$section_id || !$academic_id) {
        die("Missing required data.");
    }

    // Retrieve data
    $data = getEvaluationData($faculty_id, $section_id, $academic_id);

    // Generate PDF
    generateEvaluationPDF($data);
}

// Function to generate the PDF
function generateEvaluationPDF($data) {
    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, $_SESSION['schoolname'], 0, 1, 'C');
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 10, 'Evaluation Results', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        }

        function DrawTable($header, $data) {
            // Calculate the number of criteria and questions
            $numCriteria = count($header) - 1;
            $numQuestions = count($data[0]) - 1;

            // Calculate the fixed width for each column
            $pageWidth = $this->GetPageWidth();
            $colWidth = ($pageWidth - 20 - ($numCriteria * 10)) / ($numCriteria + $numQuestions);
            $colWidthForQuestions = $colWidth * 7 + 5; // Adjust width for the first column

            // Draw table header
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(255, 255, 255); // White fill

            // Draw the first column with a longer width
            $this->Cell($colWidthForQuestions, 7, $header[0], 1, 0, 'C', false);

            // Draw the rest of the columns with the standard width
            for ($i = 1; $i < count($header); $i++) {
                $this->Cell($colWidth, 7, $header[$i], 1, 0, 'C', false);
            }
            $this->Ln();

            // Draw table data
            $this->SetFont('Arial', '', 10);
            foreach ($data as $row) {
                for ($i = 0; $i < count($row); $i++) {
                    $this->Cell($i == 0 ? $colWidthForQuestions : $colWidth, 7, $row[$i], 1, 0, 'C');
                }
                $this->Ln();
            }
        }
        
    }

    $pdf = new PDF('L');
    $pdf->AddPage();

    $studentName = $data['facultyInfo']->faculty_fname . ' ' . $data['facultyInfo']->faculty_lname;
    $subjectCodes = [];
    foreach ($data['handles'] as $handle) {
        foreach ($data['subjects'] as $subject) {
            if ($subject->id == $handle->subject_id) {
                $subjectCodes[] = $subject->code;
            }
        }
    }
    $subjects = implode(", ", $subjectCodes);
    $courseSection = $data['sectionInfo']->class_course . '-' . $data['sectionInfo']->class_level . $data['sectionInfo']->class_section;
    $totalEvaluators = $data['totalEvaluators'] . '/' . $data['totalStudent'];
    $date = date("F j, Y");
    $header = ['Question', '1', '2', '3', '4', '5'];

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, "ID: " . $data['facultyInfo']->code, 0, 1);
    $pdf->Cell(0, 10, "Name: " . $studentName, 0, 1);
    $pdf->Cell(0, 10, "Subject: " . $subjects, 0, 1);
    $pdf->Cell(0, 10, "Course, Yr. & Sec.: " . $courseSection, 0, 1);
    $pdf->Cell(0, 10, "Total Evaluators: " . $totalEvaluators, 0, 1);
    $pdf->Cell(0, 10, "Date: " . $date, 0, 1);


    $pdf->Ln(10);
    foreach ($data['criteria'] as $criterion) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 200, 200); // Light gray fill
        $pdf->SetTextColor(0, 0, 0); // Black text
        $pdf->Cell(0, 10, $criterion->criteria, 0, 1, 'C', true);

        $tableData = [];
        foreach ($data['questions'] as $question) {
            if ($criterion->id == $question->criterias_id) {
                $row = [$question->question];
                for ($i = 1; $i <= 5; $i++) {
                    $rate_count = 0;
                    foreach ($data['evaluationResults'] as $result) {
                        if ($result->question_id == $question->id && $result->rate == $i) {
                            $rate_count = $result->rate_count;
                        }
                    }
                    $percentage = $data['totalEvaluators'] > 0 ? round(($rate_count / $data['totalEvaluators']) * 100, 1) . '%' : '0%';
                    $row[] = $percentage;
                }
                $tableData[] = $row;
            }
        }
        $pdf->DrawTable($header, $tableData);
    }

    $pdf->Output('I', 'Evaluation_Results.pdf');
}
?>
