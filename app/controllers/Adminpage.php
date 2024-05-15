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
        $year = new Acad();

        $row = $year->where(['ay_default' => '1']);
        $this->settingChange();
        currentPage('dashboard');

        $this->view('admin/dashboard', ['rows' => $row]);
    }

    public function academicyear()
    {
        $this->settingChange();
        currentPage('academicYear');
        $x = new Acad();

        $rows = $x->findAll();
        $rows2 = []; // Initialize an empty array for the modal data

        if (count($_POST) > 0) {
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $rows2 = $x->where(['id' => $id]);
            } else if (isset($_POST['updateAcad'])) {
                $id = $_POST['id'];
                $arr['academic_year'] = $_POST['academic_year'];
                $arr['semester'] = $_POST['semester'];
                $arr['status'] = $_POST['status'];
                if ($_POST['ay_default'] == 1) {
                    $x->updateDefault($id, 'ay_default', 1);
                    $x->update($id, $arr);
                    redirect('adminpage/' . $_SESSION['currentPage']);
                } else {
                    $x->update($id, $arr);
                    redirect('adminpage/' . $_SESSION['currentPage']);
                }
            } else {
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }

        $this->view('admin/academic_year', [
            'rows' => $rows,
            'rows2' => $rows2, // Pass the modal data to the view
        ]);
    }

    public function classlist()
    {
        $this->settingChange();
        currentPage('classList');
        $x = new Section();
        if (count($_POST) > 0) {
            if (isset($_POST['searchClass'])) {
                $x = new Section();
                $searchTerm = $_POST['searchBox'];
                $columns = ['class_course', 'class_level', 'class_section'];
                $rows = $x->search($searchTerm, $columns);
                $this->view('admin/class_list', ['rows' => $rows]);
                exit();
            } else {
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }

        $rows = $x->findAll();
        $this->view('admin/class_list', [
            'rows' => $rows,
        ]);
    }

    public function subjectlist()
    {
        $this->settingChange();
        currentPage('subjectList');
        $x = new Subject();

        $rows = $x->findAll();
        $rows2 = []; // Initialize an empty array for the modal data

        if (count($_POST) > 0) {

            if (isset($_POST['editSubject'])) {
                $id = $_POST['id'];
                $rows2 = $x->where(['id' => $id]);
            } else if (isset($_POST['searchSubject'])) {
                $x = new Subject();
                $searchTerm = $_POST['searchBox'];
                $columns = ['code', 'subject'];
                $rows = $x->search($searchTerm, $columns);
                $this->view('admin/subject_list', ['rows' => $rows]);
                exit();
            } else if (isset($_POST['updateSubject'])) {
                $id = $_POST['id'];
                $arr['code'] = $_POST['code'];
                $arr['subject'] = $_POST['subject'];
                $x->update($id, $arr);
                redirect('adminpage/' . $_SESSION['currentPage']);
            } else {
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }

        $this->view('admin/subject_list', [
            'rows' => $rows,
            'rows2' => $rows2, // Pass the modal data to the view
        ]);
    }


    public function questions()
    {
        $this->settingChange();
        currentPage('questions');
        $x = new Acad();
        $y = new Question();
        $rows = $x->findAll();
        $rows2 = []; // Initialize an empty array for the modal data
        $question = $y->findAll();

        if (count($_POST) > 0) {
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $rows2 = $x->where(['id' => $id]);
            } else if (isset($_POST['updateAcad'])) {
                $id = $_POST['id'];
                $arr['academic_year'] = $_POST['academic_year'];
                $arr['semester'] = $_POST['semester'];
                $arr['status'] = $_POST['status'];
                if ($_POST['ay_default'] == 1) {
                    $x->updateDefault($id, 'ay_default', 1);
                    $x->update($id, $arr);
                    redirect('adminpage/' . $_SESSION['currentPage']);
                } else {
                    $x->update($id, $arr);
                    redirect('adminpage/' . $_SESSION['currentPage']);
                }
            } else {
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }

        $this->view('admin/questions', [
            'rows' => $rows,
            'rows2' => $rows2, 'questions' => $question
        ]);
    }

    public function managequestions()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $x = new Question();
            $y = new Criteria();
            $z = new Acad();
            
            if(count($_POST)>0){
$_POST['acads_id'] = $id;
                $x->insert($_POST);
            }


            $rows = $x->where(['acads_id' => $id]);
            $rows2 = $y->findAllOrder('order_by', 'ASC');
            $acads = $z->where(['id' => $id]);
            
            $this->view('admin/manage_questions', [
                'rows' => $rows,
                'rows2' => $rows2, 'acads' => $acads
            ]);
        } else {
            
        }
    }

    public function criterialist()
    {
        $this->settingChange();
        currentPage('criteriaList');


        $x = new Criteria();
        $rows2 = [];
        if (count($_POST) > 0) {
            $id = $_POST['id'];
            if (isset($_POST['editCriteria'])) {
                $rows2 = $x->where(['id' => $id]);
            } else if (isset($_POST['sortUp'])) {
                $order_by = $_POST['order_by'];


                // Get the ID of the next row based on the current order_by value
                $prevRow = $x->first(['order_by' => ($order_by - 1)]);
                if ($prevRow) {
                    $id2 = $prevRow->id;

                    // Retrieve the current order_by values of these rows
                    // Implement this method in your Criteria model to get the order_by value by ID
                    $order_by2 = $prevRow->order_by;


                    // Swap the order_by values of the rows
                    $update1 = $x->update($id, ['order_by' => $order_by2]); // Update the order_by value of the first row
                    $update2 = $x->update($id2, ['order_by' => $order_by]); // Update the order_by value of the second row

                    // Check if both updates were successful
                    if ($update1 && $update2) {
                        redirect('adminpage/' . $_SESSION['currentPage']);
                    } else {
                        // Error handling if the updates failed
                    }
                } else {
                    // Error handling if the next row does not exist
                }
            } else if (isset($_POST['sortDown'])) {
                $order_by = $_POST['order_by'];

                // Get the ID of the next row based on the current order_by value
                $nextRow = $x->first(['order_by' => ($order_by + 1)]);
                if ($nextRow) {
                    $id2 = $nextRow->id;

                    // Retrieve the current order_by values of these rows
                    // Implement this method in your Criteria model to get the order_by value by ID
                    $order_by2 = $nextRow->order_by;

                    // Swap the order_by values of the rows
                    $update1 = $x->update($id, ['order_by' => $order_by2]); // Update the order_by value of the first row
                    $update2 = $x->update($id2, ['order_by' => $order_by]); // Update the order_by value of the second row

                    // Check if both updates were successful
                    if ($update1 && $update2) {
                        redirect('adminpage/' . $_SESSION['currentPage']);
                    } else {
                        // Error handling if the updates failed
                    }
                } else {
                    // Error handling if the next row does not exist
                }
            } else if (isset($_POST['updateCriteria'])) {

                $arr['criteria'] = $_POST['criteria'];
                $x->update($id, $arr);
                redirect('adminpage/' . $_SESSION['currentPage']);
            } else {
                $max = $x->findAllOrder('order_by', 'DESC');
                $_POST['order_by'] = $max[0]->order_by + 1;
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }
        $max = $x->findAllOrder('order_by', 'DESC');
        $rows = $x->findAllOrder('order_by', 'ASC');
        $this->view('admin/criteria_list', ['rows' => $rows, 'rows2' => $rows2, 'max' => $max]);
    }

    public function studentlist()
    {

        if (isset($_POST['searchStudent'])) {

            $x = new Student();
            $y = new Section();

            $searchTerm = $_POST['searchBox'];
            $searchColumns = ['stud_code', 'stud_fname', 'stud_mname', 'stud_lname', 'stud_email'];
            $rows = $x->search($searchTerm, $searchColumns);

            $class = $x->classList();
            $classOption = $y->findAll();
            $this->view('admin/student_list', [
                'rows' => $rows, 'class' => $class, 'classOption' => $classOption
            ]);
            exit();
        }


        $this->settingChange();
        currentPage('studentList');
        $x = new Student();
        $y = new Section();
        $rows = $x->findAll();
        $class = $x->classList();
        $this->view('admin/student_list', [
            'rows' => $rows, 'class' => $class
        ]);
    }

    public function facultylist()
    {

        if (isset($_POST['searchFaculty'])) {

            $x = new Faculty();
            

            $searchTerm = $_POST['searchBox'];
            $searchColumns = ['faculty_code', 'faculty_fname', 'faculty_mname', 'faculty_lname', 'faculty_email'];
            $rows = $x->search($searchTerm, $searchColumns);

            
            
            $this->view('admin/faculty_list', [
                'rows' => $rows
            ]);
            exit();
        }


        $this->settingChange();
        currentPage('facultyList');
        $x = new Faculty();
        
        $rows = $x->findAll();
        
        $this->view('admin/faculty_list', [
            'rows' => $rows
        ]);
    }

    public function editStudent()
    {
        $id = ['id' => $_GET['id']];
        $x = new Student();
        $y = new Section();
        $rows = $x->where($id);
        $class = $x->classList();
        $classOption = $y->findAll();
        if (count($_POST) > 0) {
            if (isset($_POST['delete'])) {
                $this->deleteUser('student', $_POST['id']);
                $_SESSION['info'] = showAlert('Deleted Successfully', 'danger');
                redirect('adminpage/' . $_SESSION['currentPage']);
            } else if (isset($_POST['resetPass'])) {
                $arr['stud_pass'] = '@Student01';
                $x->update($_POST['id'], $arr);
                $_SESSION['info'] = showAlert('Password has been reset', 'success');
            } else {
                $x->update($_POST['id'], $_POST);
                $_SESSION['info'] = showAlert('Updated Successfully', 'success');
            }
        }

        $this->view('admin/edit_student', [
            'rows' => $rows, 'class' => $class, 'classOption' => $classOption
        ]);
    }

    public function editfaculty()
    {
        $id = ['id' => $_GET['id']];
        $x = new Faculty();
        $rows = $x->where($id);
        if (count($_POST) > 0) {
            if (isset($_POST['delete'])) {
                $this->deleteUser('faculty', $_POST['id']);
                $_SESSION['info'] = showAlert('Deleted Successfully', 'danger');
                redirect('adminpage/' . $_SESSION['currentPage']);
            } else if (isset($_POST['resetPass'])) {
                $arr['faculty_pass'] = '@Faculty01';
                $x->update($_POST['id'], $arr);
                $_SESSION['info'] = showAlert('Password has been reset', 'success');
            } else {
                $x->update($_POST['id'], $_POST);
                $_SESSION['info'] = showAlert('Updated Successfully', 'success');
            }
        }

        $this->view('admin/edit_faculty', [
            'rows' => $rows
        ]);
    }

    

    public function deleteUser($type, $id)
    {
        $x = '';
        if ($type == "student") {
            $x = new Student();
        } else if ($type == "faculty") {
            $x = new Faculty();
        } else {
            $x = new Admin();
        }
        $x->delete($id);
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
            redirect('adminpage/' . $_SESSION['currentPage']);
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
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }
        $this->view('admin/add_student', [
            'rows' => $rows, 'class' => $class, 'classOption' => $classOption
        ]);
    }

    public function addfaculty()
    {
        $x = new Faculty();
        $rows = $x->findAll();

        if (count($_POST) > 0) {
            $_POST['faculty_pass'] = '@Faculty01';
            $checkId = $x->where(['faculty_code' => $_POST['faculty_code']]);
            if ($checkId) {
                $_SESSION['errorId'] = showAlert('The ID "' . $_POST['faculty_code'] . '" is already taken!', 'danger');
            } else {
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }
        $this->view('admin/add_faculty', [
            'rows' => $rows
        ]);
    }
}
