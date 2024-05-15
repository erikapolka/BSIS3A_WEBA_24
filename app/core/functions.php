<?php

function show($stuff)
{

    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
    //print_r(explode("/" , trim($_GET['url'], "/")));
}

function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
}

function get_var($key)
{
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
}

function get_selected($key, $value)
{
    if (isset($_POST[$key])) {
        if (isset($_POST[$key]) == $value) {
            return 'selected';
        }
    }
    return '';
}

function random_string($length)
{
    $array = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

    $text = "";

    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, 61);
        $text .= $array[$random];
    }

    return $text;
}

function currentPage($page)
{
    if (!isset($_SESSION['currentPage'])) {
        $_SESSION['currentPage'] = 'dashboard';
    } else {
        $_SESSION['currentPage'] = $page;
    }
}

function showAlert($message, $type = 'info')
{
    // Set the alert type (info, success, warning, danger)

    switch ($type) {
        case 'success':
            $iconClass = 'fa fa-check-circle';
            break;
        case 'warning':
            $iconClass = 'fa fa-exclamation-triangle';
            break;
        case 'danger':
            $iconClass = 'fa fa-times-circle';
            break;
        default:
            $iconClass = 'fa fa-info-circle';
            break;
    }

    // Display the alert message
    return '
<div class="container">
    <div class="alert alert-' . $type . ' alert-dismissible fade show mx-auto" role="alert" style="max-width: 30rem;">
        <i class="' . $iconClass . ' h4"></i> 
        ' . $message . '
        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>';
}

function showAlertOnce($message, $type = 'info', $alertname)
{
    if (!isset($_SESSION[$alertname]) || !$_SESSION[$alertname]) {

        return showAlert($message, $type);
    }
    return ''; // Return empty string if alert has already been shown
}


function getErrorMessageIfEmpty($inputs, $fieldNames)
{
    foreach ($inputs as $key => $input) {
        if (empty($input)) {
            $fieldName = isset($fieldNames[$key]) ? ucfirst($fieldNames[$key]) : 'Field';
            return $fieldName . ' cannot be empty.';
        }
    }
    return ''; // No error message
}


function settingUpdate()
{
    $set = new Setting();
    $setId = ['id' => 1];
    $settings = $set->where($setId);
    foreach ($settings as $set) {
        $_SESSION['systemname'] = $set->set_systemname;
        $_SESSION['theme'] = $set->set_theme;
        $_SESSION['logo'] = $set->set_logo;
        $_SESSION['schoolname'] = $set->set_schoolname;
        $_SESSION['semester'] = $set->set_sem;
        $_SESSION['acadyear'] = $set->set_acadyear;
    }
}
