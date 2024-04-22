<?php

function show($stuff){

    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
    //print_r(explode("/" , trim($_GET['url'], "/")));
}

function redirect($path){
    header("Location: " . ROOT . "/" . $path);
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
    <div class="alert alert-' . $type . ' alert-dismissible fade show mx-auto mt-3 text-center" role="alert" style="max-width: 30rem;">
        <i class="' . $iconClass . ' h4"></i> 
        ' . $message . '
    </div>
</div>';
}