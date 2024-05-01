<?php

session_start();
// Check if the user is not logged in (no active session)
if (!isset($_SESSION['userId']) || $_SESSION['currentUser'] !== 'student') {
    // Redirect the user to the login page
    redirect("404");
    exit(); // Stop further execution of the script
}
$theme = $_SESSION['theme'];
// If the user is logged in, continue to the restricted page
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['systemname']?></title>
    <!-- Bootstrap CSS -->
    <base href="<?= BASEURL ?>">
    <link rel="icon" type="image/x-icon" href="public/resources/<?= $_SESSION['logo']?>">
    <link rel="stylesheet" href="css/main_theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        /* Content */
        .content {
            transition: margin-left 0.3s;
            padding: 1rem;
            margin-left: 5rem;
            /* Adjust margin to accommodate sidebar width */
            padding-top: 6.25rem;
            padding-left: 1rem;
            z-index: 999;
            /* Ensure content appears below navbar and sidebar */
            /* Width of the sidebar */
        }


        /* Navbar */
        .navbar {
            z-index: 1001;
            /* Ensure navbar appears above sidebar */
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #343a40;
            padding-left: 1rem;
            /* Add padding to the left to accommodate the button */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            padding-left: 1rem;
            /* Add padding to the left of the brand */
        }

        .brand-logo {
            width: 3.75rem;
            /* Adjust width of the logo */
            height: auto;
            /* Maintain aspect ratio */
            margin-right: 1rem;
            /* Add space between logo and brand info */
        }

        .brand-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .brand-name {
            font-size: 1.2rem;
            /* Adjust font size for the brand name */
            font-weight: bold;
            /* Make the brand name bold */
        }

        .tagline {
            font-size: 0.8rem;
            /* Adjust font size for the tagline */
        }


        .dropdown-menu {
            display: block;
            opacity: 0;
            visibility: hidden;
            transform: translateY(0%);
            transition: all .5s;
            cursor: pointer;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(20%);
        }

        .dropdown .dropdown-menu .dropdown-item:hover{
            color: white;
            background-color: #343a40;
        }




        @media (max-width: 992px) {


            .navbar-toggler {
                display: none;
                /* Hide button in mobile view */
            }

            .brand-name {
                font-size: 1rem;
                /* Adjust font size for the brand name */
                font-weight: bold;
                /* Make the brand name bold */
            }

            .brand-logo {
                display: none;
            }
        }
        .custom-shadow {
    box-shadow: 0 0.4rem 6px rgba(0, 0, 0, 0.5), 0 1px 3px rgba(0, 0, 0, 0.08);
}
        @media (min-width: 992px) {}
    </style>
</head>

<body style=" font-family: Poppins;">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-evagreen">
        <div class="container">
            <!-- Brand with logo, name, and tagline -->
            <a class="navbar-brand" href="#">
                
                <img src="public/resources/<?= $_SESSION['logo'] ?>" alt="Logo" class="brand-logo img-fluid custom-shadow rounded-5">
                <div class="brand-info">
                    <div class="brand-name"><?= $_SESSION['systemname']?></div>
                    <div class="tagline"><?= $_SESSION['schoolname'] ?></div>
                </div>
            </a>
            <!-- Dropdown Button -->
            <div class="dropdown">
                <button class="btn btn-secondary rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 40px; height: 40px;">
                    <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton" id="dropdownEffect">
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> <strong><?= $_SESSION["fullName"]; ?></strong></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        </div>
    </nav>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="<?= ROOT ?>/login/logout" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>




    <div class="content" id="content">
        <div class="container-fluid">

        <?php if (!isset($_SESSION['showOnce'])) {
                echo $_SESSION['welcome'];
                $_SESSION['showOnce'] = true;
            }?>
