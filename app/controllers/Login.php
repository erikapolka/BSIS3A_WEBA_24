<?php
session_start();
class Login extends Controller
{
    public function index()
    {

        if (count($_POST) > 0) {
            $user['code'] = $_POST['code'];
            $pass = $_POST['pass'];


            if (empty($user) || empty($pass)) {
                $_SESSION["errors"] = showAlert('Username and Password cannot be empty.', 'danger');
            } else {
                $student = new Student();
                $studentResult = $student->first($user);
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
                    $adminResult = $admin->first($user);
                    if ($adminResult) {
                        if ($_POST['pass'] == $adminResult->admin_pass) {
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
                        $facultyResult = $faculty->first($user);

                        if ($facultyResult) {
                            if ($_POST['pass'] == $facultyResult->faculty_pass) {
                                Auth::authenticate($facultyResult);
                                $_SESSION["fullName"] = $facultyResult->faculty_fname . " " . $facultyResult->faculty_lname;
                                $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "(Admin)!", 'success');
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
