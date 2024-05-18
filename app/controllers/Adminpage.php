<?php
session_start();

class Adminpage extends Controller
{
    private function auto_auth()
    {
        if (!Auth::logged_in('admin')) {
            redirect('404');
        }
    }

    public function index()
    {
        $this->auto_auth();

        
        // Define the user types
        $userTypes = ['Admin', 'Student', 'Faculty', 'Section'];
        $adminList = [];
        // Loop through each user type
        foreach ($userTypes as $userType) {
            // Create an instance of the corresponding class
            $user = new $userType();

            // Find all users of the current type
            $totalUsers = $user->findAll();

            // Count the total users and store the count in a session variable
            if ($totalUsers != null) {
                $_SESSION['total' . $userType] = count($totalUsers);
            } else {
                $_SESSION['total' . $userType] = 0;
            }
        }

        $year = new Acad();

        $row = $year->where(['ay_default' => '1']);

        $this->users();
        $this->changepass();

        $this->settingChange();
        currentPage('dashboard');

        $this->view('admin/dashboard', ['rows' => $row]);
    }

    public function changepass()
    {
        //NOT WORKING
        $x = new Admin();
        if (count($_POST) > 0) {
            $seeAdmin = $x->first(['code' => $_SESSION['USER_ID']]);

            if ($_POST['admin_pass'] == $seeAdmin->admin_pass && $_POST['pass1'] == $_POST['pass2']) {
                $arr['admin_pass'] = $_POST['pass1'];
                $x->update($seeAdmin->id, $arr);
                redirect('adminpage');
                exit();
            } else {
                $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "!", 'success');
                redirect('adminpage');
            }
        }
    }
    public function users()
    {
        $x = new Admin();
        $year = new Acad();

        $row = $year->where(['ay_default' => '1']);
        if (count($_POST) > 0) {
            $seeAdmin = $x->first(['code' => $_SESSION['USER_ID']]);

            if ($_POST['admin_pass'] == $seeAdmin->admin_pass) {
                $adminList = $x->findAll();
                $this->view('admin/dashboard', ['rows' => $row, 'adminList' => $adminList]);
                exit();
            } else {
                $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "!", 'success');
                redirect('adminpage');
            }
        }
    }
    public function academicyear()
    {
        $this->auto_auth();
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
        $this->auto_auth();
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
        $this->auto_auth();
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
        $this->auto_auth();
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
        $this->auto_auth();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $x = new Question();
            $y = new Criteria();
            $z = new Acad();

            if (count($_POST) > 0) {
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
        $this->auto_auth();
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
        $this->auto_auth();
        if (isset($_POST['searchStudent'])) {

            $x = new Student();
            $y = new Section();

            $searchTerm = $_POST['searchBox'];
            $searchColumns = ['code', 'stud_fname', 'stud_mname', 'stud_lname', 'stud_email'];
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
        $rows = $x->findAllOrder('stud_lname', 'ASC');
        $class = $x->classList();
        $this->view('admin/student_list', [
            'rows' => $rows, 'class' => $class
        ]);
    }

    public function facultylist()
    {
        $this->auto_auth();
        $this->settingChange();
        currentPage('facultyList');
        $x = new Faculty();
        $y = new Handling();
        $handles = $y->findAll();

        if (isset($_POST['searchFaculty'])) {


            $searchTerm = $_POST['searchBox'];
            $searchColumns = ['code', 'faculty_fname', 'faculty_mname', 'faculty_lname', 'faculty_email'];
            $rows = $x->search($searchTerm, $searchColumns);
            $this->view('admin/faculty_list', [
                'rows' => $rows, 'handles' => $handles
            ]);
            exit();
        }

        $rows = $x->findAllOrder('faculty_lname', 'ASC');

        $this->view('admin/faculty_list', [
            'rows' => $rows, 'handles' => $handles
        ]);
    }

    public function editStudent()
    {
        $this->auto_auth();
        $id = ['token' => $_GET['id']];
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
                $arr['stud_pass'] = password_hash('@Student01', PASSWORD_DEFAULT);
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
        $this->auto_auth();
        $id = ['token' => $_GET['id']];
        $x = new Faculty();
        $y = new Subject();
        $z = new Section();
        $handlings = new Handling();

        if (count($_POST) > 0) {
            if (isset($_POST['delete'])) {
                $this->deleteUser('faculty', $_POST['id']);
                $_SESSION['info'] = showAlert('Deleted Successfully', 'danger');
                redirect('adminpage/' . $_SESSION['currentPage']);
            } else if (isset($_POST['resetPass'])) {
                $arr['faculty_pass'] = password_hash('@Faculty01', PASSWORD_DEFAULT);
                $x->update($_POST['id'], $arr);
                $_SESSION['info'] = showAlert('Password has been reset', 'success');
            } else if (isset($_POST['section_id']) && !empty($_POST['section_id'])) {
                // Retrieve the selected sections
                $fid = $x->first($id);
                $selectedSections = $_POST['section_id'];
                $faculty_id = $fid->id;
                $subject_id = $_POST['subject_id'];

                // Assume $handlings is an instance of your database handling class
                foreach ($selectedSections as $section_id) {
                    $arr = [
                        'faculty_id' => $faculty_id,
                        'subject_id' => $subject_id,
                        'section_id' => $section_id
                    ];
                    // Insert the data into the database
                    $handlings->insert($arr);
                }
            } else {
                $x->update($_POST['id'], $_POST);
                $_SESSION['info'] = showAlert('Updated Successfully', 'success');
            }
        }
        $rows = $x->where($id);
        $subjects = $y->findAllOrder('code', 'ASC');
        $sections = $z->findAllOrder('class_course', 'ASC');
        $class = $x->classList();
        $showHandlings = $handlings->where(['faculty_id' => $rows[0]->id]);
        $this->view('admin/edit_faculty', [
            'rows' => $rows, 'subjects' => $subjects, 'class' => $class, 'sections' => $sections, 'handles' => $showHandlings
        ]);
    }



    public function deleteUser($type, $id)
    {
        $this->auto_auth();
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
        $this->auto_auth();

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
                $uploadDir = '../public/assets/images/';
                $uploadFile = $uploadDir . 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $logoName = 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $existingLogoFile = $uploadDir . $_SESSION['logo'];

                // Delete existing logo file if it exists
                if (file_exists($existingLogoFile)) {
                    unlink($uploadFile);
                }

                // Move uploaded file to destination folder
                if (move_uploaded_file($_FILES['photo']['tmp_name'], '../public/assets/images/' . 'logo.' . pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION))) {
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
        $this->auto_auth();
        $x = new Student();
        $y = new Section();
        $rows = $x->findAll();
        $class = $x->classList();
        $classOption = $y->findAll();

        if (count($_POST) > 0) {
            $checkId = $x->where(['code' => $_POST['code']]);
            if ($checkId) {
                $_SESSION['errorId'] = showAlert('The Student ID "' . $_POST['code'] . '" is already taken!', 'danger');
            } else {
                $_POST['stud_pass'] = password_hash('@Student01', PASSWORD_DEFAULT);
                $_POST['token'] = random_string(60);
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
        $this->auto_auth();
        $x = new Faculty();
        $rows = $x->findAll();

        if (count($_POST) > 0) {
            $checkId = $x->where(['code' => $_POST['code']]);
            if ($checkId) {
                $_SESSION['errorId'] = showAlert('The ID "' . $_POST['code'] . '" is already taken!', 'danger');
            } else {
                $_POST['faculty_pass'] = password_hash('@Faculty01', PASSWORD_DEFAULT);
                $_POST['token'] = random_string(60);
                $x->insert($_POST);
                redirect('adminpage/' . $_SESSION['currentPage']);
            }
        }
        $this->view('admin/add_faculty', [
            'rows' => $rows
        ]);
    }
}
