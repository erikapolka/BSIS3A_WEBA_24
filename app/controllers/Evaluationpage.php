<?php
session_start();
class Evaluationpage extends Controller
{
    private function auto_auth()
    {

        if (!Auth::logged_in('student')) {
            redirect('404');
        }
    }

    public function index()
    {
        $this->auto_auth();

        $acads = new Acad();
        $acads_default = $acads->first(['ay_default' => 1]);

        $this->view("student/home", ['acads_default' => $acads_default]);
    }
    public function instructors()
    {
        $this->auto_auth();
        $id = ['token' => $_GET['id']];

        $studentx = new Student();
        $handles = new Handling();
        $facultyx = new Faculty();
        $evaluationx = new Evaluation();
        $subjectx = new Subject();
        $acads = new Acad();
        
        $student = $studentx->first($id);
        $handleList = $handles->where(['section_id' => $student->stud_class]);
        $subjects = $subjectx->findAll();
        $acads_default = $acads->first(['ay_default' => 1]);
        
        $faculty = $facultyx->findAll();
        $facultyIndexed = [];
        $disabledStatus = [];
        if ($handleList != null) {
            foreach ($handleList as $handle) {
                $fac = $facultyx->first(['id' => $handle->faculty_id]);
                $facultyIndexed[$fac->id] = $fac;

                $criteria = [
                    'academic_id' => $acads_default->id, // Assuming a fixed academic_id
                    'class_id' => $student->stud_class,
                    'subject_id' => $handle->subject_id,
                    'faculty_id' => $fac->id,
                    'stud_id' => $student->id
                ];


                $existingData = $evaluationx->first($criteria);


                $disabledStatus[$fac->id] = ($existingData) ? 'disabled' : '';
            }
        }
        $this->view("student/instructors", [
            'handles' => $handleList,
            'student' => $student,
            'facultys' => $facultyIndexed,
            'disabledStatus' => $disabledStatus,
            'subjects' => $subjects
        ]);
    }


    public function take()
    {
        $id = ['token' => $_GET['id']];
        $fid = ['token' => $_GET['fid']];
        if (!isset($_GET['id']) || !isset($_GET['fid'])) {
            // Redirect or show an error message
            redirect('404');
        }

        $this->auto_auth();
        if (count($_POST) > 0) {
            $token = random_string(25);
            // Collect data for evaluations table
            $dataEvaluations = [
                'academic_id' => $_POST['academic_id'],
                'class_id' => $_POST['class_id'],
                'stud_id' => $_POST['stud_id'],
                'subject_id' => $_POST['subject_id'],
                'faculty_id' => $_POST['faculty_id'],
                'date_taken' => date('Y-m-d H:i:s'),
                'comment' => $_POST['comment'],
                'token' => $token
            ];

            $evaluationx = new Evaluation();

            $evaluationx->insert($dataEvaluations);

            // Process each question's rating
            $resultx = new Result();
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'question_') === 0) {
                    $question_id = str_replace('question_', '', $key);
                    $rate = $value;

                    // Collect data for results table
                    $dataResults = [
                        'question_id' => $question_id,
                        'rate' => $rate,
                        'token' => $token
                    ];

                    // Insert into results table
                    $resultx->insert($dataResults);
                }
            }

            // Redirect after successful submission
            redirect('evaluationpage/instructors?id=' . $_GET['id']);
        }
        // Non-POST request handling, load and display the form


        $studentx = new Student();
        $handlex = new Handling();
        $facultyx = new Faculty();
        $criterionx = new Criteria();
        $acads = new Acad();
        $subjectx = new Subject();
        $sectionx = new Section();
        $faculty = $facultyx->first($fid);
        $student = $studentx->first($id);
        $handles = $handlex->first(['section_id' => $student->stud_class, 'faculty_id' => $faculty->id]);
        $criterion = $criterionx->findAllOrder('order_by', 'ASC');
        $acads_default = $acads->first(['ay_default' => 1]);
        $subjects = $subjectx->findAll();
        $sections = $sectionx->findAll();
        $questionModel = new Question();
        $rows = $questionModel->findAll();

        $this->view("student/take", [
            'handles' => $handles,
            'student' => $student,
            'facultys' => $faculty,
            'rows' => $rows,
            'rows2' => $criterion,
            'acads_default' => $acads_default,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }
}
