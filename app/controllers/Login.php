<?php
session_start();
class Login extends Controller
{
    public function index()
    {
        settingUpdate();
        $this->view('login');

        if (isset($_POST['login_submit'])) {
            $user = $_POST['login_id'];
            $pass = $_POST['login_pass'];

            // Validate form data
            if (empty($user) || empty($pass)) {
                // Set error message

                $_SESSION["errors"] = showAlert('Username and Password cannot be empty.', 'danger');

                // Redirect back to the form
                redirect("login");
                exit();
            } else {
                // No errors, proceed with authentication
                $student = new Student();
                $studentResult = $student->authenticate($user, $pass);

                if ($studentResult) {
                    $_SESSION["userId"] = $user;
                    $_SESSION['currentUser'] = "student";
                    $_SESSION["fullName"] = $student->getName($user);
                    $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "!", 'success');
                    redirect("evaluationpage");
                    exit();
                } else {
                    $admin = new Admin();
                    $adminResult = $admin->authenticate($user, $pass);

                    if ($adminResult) {
                        $_SESSION["userId"] = $user;
                        $_SESSION['currentUser'] = "admin";
                        $_SESSION["fullName"] = $admin->getName($user);
                        $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "(Admin)!", 'success');
                        redirect("adminpage/index");
                        exit();
                    } else {
                        $faculty = new Faculty();
                        $facultyResult = $faculty->authenticate($user, $pass);

                        if ($facultyResult) {
                            $_SESSION["userId"] = $user;
                            $_SESSION['currentUser'] = "faculty";
                            $_SESSION["fullName"] = $faculty->getName($user);
                            $_SESSION['welcome'] = showAlert('Welcome, ' . $_SESSION["fullName"] . "!", 'success');
                            redirect("facultypage");
                            exit();
                        } else {
                            $_SESSION["errors"] = showAlert('Invalid username or password.', 'danger');
                            header("Location: login");
                            exit();
                        }
                    }
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        redirect("login");
        exit();
    }


}
