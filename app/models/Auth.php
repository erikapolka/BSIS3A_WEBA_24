<?php

class Auth
{
    public static function authenticate($row)
    {
        $_SESSION['USER'] = $row;
        $_SESSION['USER_ID'] = $row->code;
        $_SESSION['TOKEN'] = $row->token;
        $_SESSION['ROLE'] = $row->usertype;
    }

    public static function logout()
    {
        if (isset($_SESSION['USER'])) {
            unset($_SESSION['USER']);
            $_SESSION = array();
            session_destroy();
        }
    }

    public static function logged_in($role)
    {
        if (isset($_SESSION['USER']) && $_SESSION['ROLE'] == $role) {
            return true;
        } else {
            return false;
        }
    }
}
