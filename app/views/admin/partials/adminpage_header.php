<?php
$theme = $_SESSION['theme'];
// Check if the user is not logged in (no active session)
if (!isset($_SESSION['userId']) || $_SESSION['currentUser'] !== 'admin') {
    // Redirect the user to the login page
    redirect("404");
    exit(); // Stop further execution of the script
}
$currentPage = $_SESSION['currentPage'];

// If the user is logged in, continue to the restricted page
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?= " " . $_SESSION['systemname'] ?></title>
    <!-- Bootstrap CSS -->
    <base href="<?= BASEURL ?>">
    <link rel="icon" type="image/x-icon" href="public/resources/<?= $_SESSION['logo'] ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main_theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">

    <style>
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 15rem;
            /* Initial sidebar width */
            min-width: 3.75rem;
            /* Minimum width of the sidebar */
            transition: width 0.3s;
            z-index: 1000;
            /* Ensure sidebar is above content */
        }

        .sidebar.collapsed {
            width: 3.75rem;
            /* Width of the collapsed sidebar */
        }

        .sidebar ul {
            list-style: none;
            padding: 6.25rem 0;
            /* Add padding to the top of the sidebar buttons */
            margin: 0;
        }

        .sidebar ul li {
            padding-left: 0;
            text-align: center;
            margin-bottom: 0;
        }

        .sidebar ul li a {
            padding-left: 0.8rem;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 3rem;
            padding-right: 0;
        }

        .sidebar ul li a i {
            font-size: 1.5rem;
            margin-right: 1rem;
            margin-left: 1rem;
        }

        .sidebar ul li a:hover {
            background-color: rgba(0, 0, 0, 0.3);
            /* New background color on hover */
        }

        /* Active (selected) state */
        .active {
            background-color: rgba(0, 0, 0, 0.3);
            /* New background color when button is active */
        }

        /* Content */
        .content {
            transition: margin-left 0.3s;
            padding: 1rem;
            margin-left: 15rem;
            /* Adjust margin to accommodate sidebar width */
            padding-top: 6.25rem;
            padding-left: 1rem;
            z-index: 999;
            /* Ensure content appears below navbar and sidebar */
            /* Width of the sidebar */
        }

        .content.collapsed {
            margin-left: 3.75rem;
            /* Width of the collapsed sidebar */
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

        .navbar-toggler {
            color: #fff;
            border: none;
            outline: none;
            position: absolute;
            /* Position the button absolutely */
            left: 1rem;
            /* Adjust the left positioning */
            top: 50%;
            /* Align the button vertically */
            transform: translateY(-50%);
            /* Center the button vertically */
        }
        .dropdown:hover{
            cursor: pointer;
        }

        label {
            font-weight: bold;
        }
        th {
    background-color: red;
    color: white;
} 

        @media (max-width: 992px) {
            .sidebar ul li a span {
                display: none;
                /* Hide full name in mobile view */
            }

            .navbar-toggler {
                display: none;
                /* Hide button in mobile view */
            }

            .sidebar ul li a i {
                font-size: 1.5rem;
                margin-left: 0.313rem;

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

        @media (min-width: 992px) {
            .sidebar.collapsed ul li a span {
                display: none;
                /* Hide labels when uncollapsed */
            }

            .sidebar ul li a i {
                font-size: 1.5rem;
                margin-left: 0.313rem;
            }
        }
    </style>
</head>

<body style=" font-family: Poppins;">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Button on the left side -->
            <button class="navbar-toggler d-none d-lg-block" type="button" id="sidebarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand with logo, name, and tagline -->
            <a class="navbar-brand" href="#">
                <img src="public/resources/<?= $_SESSION['logo'] ?>" alt="Logo" class="brand-logo">
                <div class="brand-info">
                    <div class="brand-name"><?= $_SESSION['systemname'] ?></div>
                    <div class="tagline"><?= $_SESSION['schoolname'] ?></div>
                </div>
            </a>
            <!-- Dropdown Button -->
            <div class="dropdown">
                <button class="btn btn-secondary rounded-circle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 40px; height: 40px;">
                    <i class="fas fa-user"></i> <!-- Font Awesome user icon -->
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> <strong><?= $_SESSION["fullName"]; ?></strong></a>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#settingsModal"><i class="fa fa-cog"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        </div>
    </nav>


    <!-- Logout Modal -->
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


    <!-- Sidebar -->
    <div class="sidebar bg-<?= $theme ?>" id="sidebar">
        <ul>
            <li><a href="<?= ROOT ?>/adminpage/dashboard" <?php if ($currentPage == 'dashboard') echo 'class="active"' ?>><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
            <li><a href="<?= ROOT ?>/adminpage/questions" <?php if ($currentPage == 'questions') echo 'class="active"' ?>><i class="fa fa-clipboard-question"></i><span>Questionnaires</span></a></li>
            <li><a href="<?= ROOT ?>/adminpage/criterialist" <?php if ($currentPage == 'criteriaList') echo 'class="active"' ?>><i class="fa fa-list-check"></i><span>Criterias</span></a></li>
            <hr>
            <li><a href="<?= ROOT ?>/adminpage/academicyear" <?php if ($currentPage == 'academicYear') echo 'class="active"' ?>><i class="fa fa-calendar"></i><span>Academic Year</span></a></li>
            <li><a href="<?= ROOT ?>/adminpage/classlist" <?php if ($currentPage == 'classList') echo 'class="active"' ?>><i class="fa fa-book"></i><span>Classes</span></a></li>
            <li><a href="<?= ROOT ?>/adminpage/subjectList" <?php if ($currentPage == 'subjectList') echo 'class="active"' ?>><i class="fa fa-note-sticky"></i><span>Subjects</span></a></li>
            <hr>
            <li><a href="<?= ROOT ?>/adminpage/facultylist" <?php if ($currentPage == 'facultyList') echo 'class="active"' ?>><i class="fa fa-chalkboard-user"></i><span>Faculties</span></a></li>
            <li><a href="<?= ROOT ?>/adminpage/studentlist" <?php if ($currentPage == 'studentList') echo 'class="active"' ?>><i class="fa fa-user-friends"></i><span>Students</span></a></li>
            <hr>
            <li><a href="<?= ROOT ?>/adminpage/settings" class=""><i class="fa-solid fa-square-poll-vertical"></i><span><strong>RESULTS</strong></span></a></li>
        </ul>
    </div>






    <div class="content" id="content">
        <div class="container-fluid">