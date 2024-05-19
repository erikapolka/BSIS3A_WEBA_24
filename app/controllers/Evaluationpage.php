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

    public function error(){
        $this->auto_auth();
        $this->view('student/error');
    }

    public function index()
    {
        $this->auto_auth();
        currentPage('home');
        $acads = new Acad();
        $acads_default = $acads->first(['ay_default' => 1]);

        $studentx = new Student();
        $handles = new Handling();
        $facultyx = new Faculty();
        $evaluationx = new Evaluation();
        $subjectx = new Subject();


        $student = $studentx->first(['token' => $_SESSION['TOKEN']]);
        $handleList = $handles->where(['section_id' => $student->stud_class]);

        $acads_default = $acads->first(['ay_default' => 1]);
        $subjectsArray = $subjectx->findAll();

        // Create an associative array for subjects with subject IDs as keys
        $subjects = [];
        foreach ($subjectsArray as $subject) {
            $subjects[$subject->id] = $subject;
        }

        $faculty = $facultyx->findAll();
        $facultyIndexed = [];
        $disabledStatus = [];
        $instructorSubjects = [];

        if ($handleList != null) {
            foreach ($handleList as $handle) {
                $fac = $facultyx->first(['id' => $handle->faculty_id]);
                $facultyIndexed[$fac->id] = $fac;

                if (!isset($instructorSubjects[$fac->id])) {
                    $instructorSubjects[$fac->id] = [];
                }
                if (isset($subjects[$handle->subject_id])) {
                    $instructorSubjects[$fac->id][] = $subjects[$handle->subject_id];
                }

                $criteria = [
                    'academic_id' => $acads_default->id,
                    'class_id' => $student->stud_class,
                    'faculty_id' => $fac->id,
                    'stud_id' => $student->id
                ];

                $existingData = $evaluationx->first($criteria);
                $disabledStatus[$fac->id] = ($existingData) ? 'disabled' : '';
            }
        }

        $evalCount = [];
        $countEval = $evaluationx->where(['academic_id' => $acads_default->id, 'stud_id' => $student->id]);
        if ($countEval != null) {
            $evalCount = count($countEval);
        } else {
            0;
        }



        $this->view("student/home", [
            'acads_default' => $acads_default,
            'instructorSubjects' => $instructorSubjects,
            'evalCount' => $evalCount
        ]);
    }

    public function changepass()
    {

        $this->auto_auth();
        $x = new Student();
        if (isset($_POST['changePass'])) {
            $student = $x->first(['token' => $_SESSION['TOKEN']]);

            if (password_verify($_POST['stud_pass'], $student->stud_pass)) {
                if($_POST['pass1'] != $_POST['pass2']){
                    redirect('evaluationpage/' . $_SESSION['currentPage']. '?id='.$_SESSION['TOKEN']);
                $_SESSION['info'] = showAlert('The new and confirm password is not matched.', 'danger');
                }
                else{
                    $arr['stud_pass'] = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
                    $x->update($student->id, $arr);
                    redirect('evaluationpage/' . $_SESSION['currentPage']. 'id?='.$_SESSION['TOKEN']);
                    $_SESSION['info'] = showAlert('Password was changed successfully!', 'success');
                }
                
                
            } else {
                redirect('evaluationpage/' . $_SESSION['currentPage']. '?id='.$_SESSION['TOKEN']);
                $_SESSION['info'] = showAlert('Your Password is incorrect.', 'danger');
                
            }
        }
    }



    public function instructors()
    {
        $this->auto_auth();
        currentPage('instructors');
        $id = ['token' => $_GET['id']];

        $studentx = new Student();
        $handles = new Handling();
        $facultyx = new Faculty();
        $evaluationx = new Evaluation();
        $subjectx = new Subject();
        $acads = new Acad();

        $student = $studentx->first($id);
        $handleList = $handles->where(['section_id' => $student->stud_class]);

        $acads_default = $acads->first(['ay_default' => 1]);
        $subjectsArray = $subjectx->findAll();

        // Create an associative array for subjects with subject IDs as keys
        $subjects = [];
        foreach ($subjectsArray as $subject) {
            $subjects[$subject->id] = $subject;
        }

        $faculty = $facultyx->findAll();
        $facultyIndexed = [];
        $disabledStatus = [];
        $instructorSubjects = [];

        if ($handleList != null) {
            foreach ($handleList as $handle) {
                $fac = $facultyx->first(['id' => $handle->faculty_id]);
                $facultyIndexed[$fac->id] = $fac;

                if (!isset($instructorSubjects[$fac->id])) {
                    $instructorSubjects[$fac->id] = [];
                }
                if (isset($subjects[$handle->subject_id])) {
                    $instructorSubjects[$fac->id][] = $subjects[$handle->subject_id];
                }

                $criteria = [
                    'academic_id' => $acads_default->id,
                    'class_id' => $student->stud_class,
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
            'subjects' => $subjects,
            'instructorSubjects' => $instructorSubjects
        ]);
    }



    public function take()
    {
        currentPage('take');
        $this->auto_auth();
        $id = ['token' => $_GET['id']];
        $fid = ['token' => $_GET['fid']];
        if (!isset($_GET['id']) || !isset($_GET['fid'])) {
            // Redirect or show an error message
            redirect('404');
        }



        if (count($_POST) > 0) {
            $token = random_string(25);
            // Collect data for evaluations table
            $dataEvaluations = [
                'academic_id' => $_POST['academic_id'],
                'class_id' => $_POST['class_id'],
                'stud_id' => $_POST['stud_id'],
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

        // Find all subjects handled by this faculty in this section
        $handles = $handlex->where(['section_id' => $student->stud_class, 'faculty_id' => $faculty->id]);

        $criterion = $criterionx->findAllOrder('order_by', 'ASC');
        $acads_default = $acads->first(['ay_default' => 1]);
        $subjects = $subjectx->findAll();
        $sections = $sectionx->first(['id' => $student->stud_class]);
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

    public function certificate()
    {
        $this->auto_auth();
        $id = ['token' => $_GET['id']];
        if (!isset($_GET['id'])) {
            // Redirect or show an error message
            redirect('404');
        }
        $studentx = new Student();
        $acads = new Acad();
        $acads_default = $acads->first(['ay_default' => 1]);
        $studentInfo = $studentx->first(['token' => $_GET['id']]);
        $this->view('student/certificate', [
            'acads_default' => $acads_default,
            'studentInfo' => $studentInfo
        ]);
    }
}
