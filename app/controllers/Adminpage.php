<?php
session_start();

class Adminpage extends Controller
{
    public function index()
    {

        // Define the user types
        $userTypes = ['Admin', 'Student', 'Faculty'];

        // Loop through each user type
        foreach ($userTypes as $userType) {
            // Create an instance of the corresponding class
            $user = new $userType();

            // Find all users of the current type
            $totalUsers = $user->findAll();

            // Count the total users and store the count in a session variable
            $_SESSION['total' . $userType] = count($totalUsers);
        }

        $this->settingChange();
        $_SESSION['currentPage'] =  'dashboard';
        $this->view('admin/dashboard');
    }

    public function studentlist()
    {

        if(isset($_POST['searchStudent'])) {
            $this->addStudent();
            $this->settingChange();
            $_SESSION['currentPage'] =  'studentList';
    
            $x = new Student();
            $y = new Section();


            $rows = $x->findAll();
            $class = $x->classList();
            $classOption = $y->findAll();
            $this->view('admin/student_list', [
                'rows' => $rows, 'class' => $class, 'classOption' => $classOption
            ]);

        }

        
        $this->settingChange();
        $_SESSION['currentPage'] =  'studentList';

        $x = new Student();
        $y = new Section();
        $rows = $x->findAll();
        $class = $x->classList();
        $this->view('admin/student_list', [
            'rows' => $rows, 'class' => $class
        ]);
    }

    public function viewStudent(){
        if(count($_POST) > 0){
            $id = $_POST['stud_id'];

            $x = new Student();
            $rows = $x->where($id);

            foreach($rows as $row){
                $_SESSION['studname'] = $row->stud_fname;
            }
        }
    }    

    public function settings()
    {
        $this->settingChange();
        $this->view('admin/settings');
    }


    public function settingChange()
    {
        $setting = new Setting();

        if (isset($_POST['btn_settings'])) {
            $arr['set_systemname'] = $_POST['systemname'];
            $arr['set_theme'] = $_POST['themeColor'];
            //$arr['set_logo'] = $_POST['photo'];
            $arr['set_schoolname'] = $_POST['schoolname'];
            $arr['set_sem'] = $_POST['semester'];
            $arr['set_acadyear'] = $_POST['acadyear'];


            // Check if file is uploaded
            if (!empty($_FILES['photo']['tmp_name'])) {
                $uploadDir = '../public/resources/';
                $uploadFile = $uploadDir . 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $logoName = 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $existingLogoFile = $uploadDir . $_SESSION['logo'];

                // Delete existing logo file if it exists
                if (file_exists($existingLogoFile)) {
                    unlink($uploadFile);
                }

                // Move uploaded file to destination folder
                if (move_uploaded_file($_FILES['photo']['tmp_name'], '../public/resources/' . 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION))) {
                    // Update logo in database
                    $arr['set_logo'] = $logoName;


                    // Update session with new logo path
                    //$_SESSION['logo'] = "logo";
                } else {
                    echo 'Error uploading file.';
                }
            }
            $setting->update('1', $arr);
            settingUpdate();
            $currentPage = isset($_SESSION['currentPage']) ? $_SESSION['currentPage'] : 'dashboard';
            redirect('adminpage/' . $currentPage);
        }
    }


    public function addstudent()
    {
        $x = new Student();
        $y = new Section();
        $rows = $x->findAll();
        $class = $x->classList();
        $classOption = $y->findAll();

        if (count($_POST) > 0) {
            $_POST['stud_pass'] = '@Student01';
            $checkId = $x->where(['stud_code' => $_POST['stud_code']]);
            if ($checkId) {
                $_SESSION['errorId'] = showAlert('The Student ID "' . $_POST['stud_code'] . '" is already taken!', 'danger');
            } else {
                $x->insert($_POST);
                redirect('adminpage/studentlist');
                exit();
            }
        }
        $this->view('admin/add_student', [
            'rows' => $rows, 'class' => $class, 'classOption' => $classOption
        ]);
    }
}
