<?php
session_start();
class Facultypage extends Controller{

    private function auto_auth()
    {
        if (!Auth::logged_in('faculty')) {
            redirect('404');
        }
    }
    public function error(){
        $this->auto_auth();
        $this->view('faculty/error');
    }

    public function index()
    {
        $this->auto_auth();
        currentPage('home');
        $acads = new Acad();
        $acads_default = $acads->first(['ay_default' => 1]);


        $this->view("faculty/home", [
            'acads_default' => $acads_default,
        ]);
    }

    public function changepass()
    {

        $this->auto_auth();
        $x = new Faculty();
        if (isset($_POST['changePass'])) {
            $faculty = $x->first(['token' => $_SESSION['TOKEN']]);

            if (password_verify($_POST['password'], $faculty->faculty_pass)) {
                if($_POST['pass1'] != $_POST['pass2']){
                    redirect('facultypage/' . $_SESSION['currentPage']. '?id='.$_SESSION['TOKEN']);
                $_SESSION['info'] = showAlert('The new and confirm password is not matched.', 'danger');
                }
                else{
                    $arr['faculty_pass'] = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
                    $x->update($faculty->id, $arr);
                    redirect('facultypage/' . $_SESSION['currentPage']. 'id?='.$_SESSION['TOKEN']);
                    $_SESSION['info'] = showAlert('Password was changed successfully!', 'success');
                }
                
                
            } else {
                redirect('facultypage/' . $_SESSION['currentPage']. '?id='.$_SESSION['TOKEN']);
                $_SESSION['info'] = showAlert('Your Password is incorrect.', 'danger');
                
            }
        }
    }

    public function result()
    {
        $this->auto_auth();
        currentPage('result');
        $id = ['token' => $_GET['id']];
        if (!isset($_GET['id'])) {
            // Redirect or show an error message
            redirect('404');
        }
        currentPage('result');
        $acadx = new Acad();
        $acads_default = $acadx->first(['ay_default' => 1]);

        $sectionx = new Section();
        $sections = $sectionx->findAll();

        $facultyx = new Faculty();
        $faculties = $facultyx->findAll();

        $subjectx = new Subject();
        $subjects = $subjectx->findAll();
        $studentx = new Student();
        $handlex = new Handling();
        $handles = $handlex->findAll();
        $evaluationResults = [];
        $criteria = [];
        $questions = [];
        $facultyInfo = [];
        $sectionInfo = [];
        $handledSections = [];
        $comments = [];
        $totalEvaluators = 0;
        $totalStudent = 0;
        // Array to store total evaluators for each section

        if (isset($_GET['id'])) {
            $handledSections = [];
            if (isset($_GET['id'])) {
                $getFaculty = $facultyx->first(['token' => $_GET['id']]);
                $handles = $handlex->where(['faculty_id' => $getFaculty->id]);
                $handledSectionsIds = [];
                foreach ($handles as $handle) {
                    $handledSectionsIds[$handle->section_id] = true;
                }
                foreach ($handledSectionsIds as $sectionId => $_) {
                    $section = $sectionx->first(['id' => $sectionId]);
                    $handledSections[] = $section;
                }
            }
            if (isset($_POST['section_id'])) {
                $academic_id = $_POST['academic_id'];
                $section_id = $_POST['section_id'];
                $faculty_id = $getFaculty->id;

                $evaluationx = new Evaluation();
                $criterionx = new Criteria();
                $questionx = new Question();


                $handles = $handlex->where(['section_id' => $section_id, 'faculty_id' => $faculty_id]);

                $criteria = $criterionx->findAllOrder('order_by', 'ASC');
                $questions = $questionx->findAll();

                $evaluationResults = $evaluationx->getEvaluationResultsBySectionAndFaculty($section_id, $faculty_id, $academic_id);

                // Calculate the total number of evaluators for each section
                $totalx = $evaluationx->where(['class_id' => $section_id, 'faculty_id' => $faculty_id, 'academic_id' => $academic_id]);

                if (!empty($totalx)) {
                    $totalEvaluators = count($totalx);
                } else {
                    $totalEvaluators = 0;
                }
                $totaly = $studentx->where(['stud_class' => $section_id]);
                if (!empty($totaly)) {
                    $totalStudent = count($totaly);
                } else {
                    $totalStudent = 0;
                }
                $facultyInfo = $facultyx->first(['id' => $faculty_id]);
                $sectionInfo = $sectionx->first(['id' => $section_id]);
                // Fetch selected section, faculty, and subject details
                $comments = $evaluationx->where(['class_id' => $section_id, 'faculty_id' => $faculty_id, 'academic_id' => $academic_id]);
            }
        }

        $this->view("faculty/result", [
            'acads_default' => $acads_default,
            'sections' => $sections,
            'faculties' => $faculties,
            'subjects' => $subjects,
            'handles' => $handles,
            'evaluationResults' => $evaluationResults,
            'criteria' => $criteria,
            'questions' => $questions,
            'totalEvaluators' => $totalEvaluators,
            'totalStudent' => $totalStudent,
            'facultyInfo' => $facultyInfo,
            'sectionInfo' => $sectionInfo,
            'handledSections' => $handledSections,
            'comments' => $comments
        ]);
    }
}