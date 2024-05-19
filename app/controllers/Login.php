<?php
session_start();
class Login extends Controller
{
    public function index()
    {

        if (count($_POST) > 0) {
            $user = $_POST['code'];
            $pass = $_POST['pass'];


            if (empty($user) || empty($pass)) {
                $_SESSION["errors"] = showAlert('Username and Password cannot be empty.', 'danger');
            } else {
                $student = new Student();
                if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                    $arr['stud_email'] = $user;
                    $studentResult = $student->first(['stud_email'=>$_POST['code']]);
                } else {
                    $studentResult = $student->first(['code'=>$_POST['code']]);
                }
                if ($studentResult) {
                    if (password_verify($_POST['pass'], $studentResult->stud_pass)) {
                        Auth::authenticate($studentResult);
                        $_SESSION["fullName"] = $studentResult->stud_fname . " " . $studentResult->stud_lname;
                        $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "!", 'success');
                        redirect("evaluationpage");
                        exit();
                    }else {
                        $_SESSION["errors"] = showAlert('Invalid username or password.', 'danger');
                    }
                } else {
                    $admin = new Admin();
                    if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                        $adminResult = $admin->first(['admin_email' => $_POST['code']]);
                    } else {
                        $adminResult = $admin->first(['code' => $_POST['code']]);
                    }
                    
                    if ($adminResult) {
                        if (password_verify($_POST['pass'], $adminResult->admin_pass)) {
                            Auth::authenticate($adminResult);
                            $_SESSION["fullName"] = $adminResult->admin_fname . " " . $adminResult->admin_lname;
                            $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "(Admin)!", 'success');
                            redirect("adminpage/index");
                            exit();
                        }else {
                            $_SESSION["errors"] = showAlert('Invalid username or password.', 'danger');
                        }
                    } else {
                        $faculty = new Faculty();
                        if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
                            $arr['faculty_email'] = $user;
                            $facultyResult = $faculty->first(['faculty_email'=>$_POST['code']]);
                        } else {
                            $facultyResult = $faculty->first(['code'=>$_POST['code']]);
                        }

                        if ($facultyResult) {
                            if (password_verify($_POST['pass'], $facultyResult->faculty_pass)) {
                                Auth::authenticate($facultyResult);
                                $_SESSION["fullName"] = $facultyResult->faculty_fname . " " . $facultyResult->faculty_lname;
                                $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "(Instructor)!", 'success');
                                redirect("facultypage");
                                exit();
                            }else {
                                $_SESSION["errors"] = showAlert('Invalid username or password.', 'danger');
                            }
                        } else {
                            $_SESSION["errors"] = showAlert('Invalid username or password.', 'danger');
                        }
                    }
                }
            }
        }
        settingUpdate();
        $this->view('login');
    }

    public function logout()
    {
        Auth::logout();
        redirect("login");
    }
}
