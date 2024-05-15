<?php

class Auth
{
    public static function authenticate($row)
    {
        $_SESSION['USER'] = [
            'id' => $row['id'],
            'usertype' => $row['usertype']
        ];
    }

    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
            $_SESSION = array();
            session_destroy();
        }
    }

    public static function logged_in($userType = null)
    {

        if (isset($_SESSION['USER'])) {

            if ($userType !== null && $_SESSION['USER']['usertype'] !== $userType) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
