<?php



$theme = $_SESSION['theme'];
// If the user is logged in, continue to the restricted page
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['systemname'] ?></title>
    <!-- Bootstrap CSS -->
    <base href="<?= BASEURL ?>">
    <link rel="icon" type="image/x-icon" href="public/assets/images/<?= $_SESSION['logo'] ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main_theme.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/@jarstone/dselect/dist/css/dselect.css">
    <style>
        /* Content */
        .content {
            padding-top: 6.25rem;
            z-index: 999;
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



        .dropdown:hover {
            cursor: pointer;
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
            <a class="navbar-brand" href="<?= ROOT ?>/evaluationpage/home">

                <img src="public/assets/images/<?= $_SESSION['logo'] ?>" alt="Logo" class="brand-logo img-fluid custom-shadow rounded-5">
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
                <div class="dropdown-menu dropdown-menu-end" style="right: 0; left: auto;" aria-labelledby="dropdownMenuButton" id="dropdownEffect">
                    <a class="dropdown-item" data-toggle="modal" data-target="#infoModal"><i class="fa fa-user"></i> <strong><?= $_SESSION["fullName"]; ?></strong></a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#changePassModal"><i class="fa fa-lock"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        </div>
    </nav>

<!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">User Information</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-5">
                        <p> Code: <?= $_SESSION['USER']->code ?></p>
                        <p>Name: <?= $_SESSION['USER']->stud_fname . ' ' . $_SESSION['USER']->stud_mname . ' ' . $_SESSION['USER']->stud_lname ?></p>
                        <p>Email: <?= $_SESSION['USER']->stud_email ?></p>
                        <p>Role: <?= $_SESSION['USER']->usertype ?></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


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


    <!-- Change Pass Modal -->
    <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePassModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="<?= ROOT ?>/evaluationpage/changepass" method="post">
                    <div class="modal-body">
                        <div class="form-group m-3">
                            <label for="password"><strong>Password:</strong></label>
                            <input type="password" class="form-control" id="password" name="stud_pass" required autocomplete="off">
                        </div>
                        <div class="form-group m-3">
                            <label for="pass1"><strong>New Password:</strong></label>
                            <input type="password" class="form-control" id="pass1" name="pass1" required autocomplete="off">
                        </div>
                        <div class="form-group m-3">
                            <label for="pass2"><strong>Confirm New Password:</strong></label>
                            <input type="password" class="form-control" id="pass2" name="pass2" required autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button type="submit" name="changePass" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <div class="content" id="content">
        <div class="container-fluid">
            <?php if (isset($_SESSION["info"])) : ?>
                <?php echo ($_SESSION["info"]) ?>
                <?php unset($_SESSION["info"]); // Clear the error message from session 
                ?>
            <?php endif; ?>
            <?php if (!isset($_SESSION['showOnce'])) {
                echo $_SESSION['welcome'];
                $_SESSION['showOnce'] = true;
            } ?>