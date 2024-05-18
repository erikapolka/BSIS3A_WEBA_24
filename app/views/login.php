<?php $theme = $_SESSION['theme']; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?= " " . $_SESSION['systemname'] ?></title>
    <link rel="icon" type="image/x-icon" href="../public/assets/images/<?= $_SESSION['logo'] ?>">
    <link rel="stylesheet" href="../css/main_theme.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<body class="container bg-light" style=" font-family: Poppins; background-image: url('../public/assets/images/login_bg.png');  background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
    <div class="container-fluid my-5">
        <div class="container d-flex justify-content-center align-items-center">
            <img src="../public/assets/images/<?= $_SESSION['logo'] ?>" style="height: 9.375rem;" alt="">
            <h1 class="text-<?= $theme ?>"><?= $_SESSION['schoolname'] ?></h1>
        </div>
    </div>
    <!-- Display error message if any -->
    <?php if (isset($_SESSION["errors"])) : ?>
        <?php echo ($_SESSION["errors"]) ?>
        <?php unset($_SESSION["errors"]); // Clear the error message from session 
        ?>
    <?php endif; ?>
    <div class="container-fluid d-flex justify-content-center mb-5" >
        <div class="row d-flex justify-content-center border border-<?= $theme ?> shadow" style="width: 80%; height: 25rem;">
            <div class="col-lg-6 col-sm-12 bg-<?= $theme ?> d-flex align-items-center">
                <div class="d-flex">

                    <div class="row">
                        <p class="text-white fs-5 fw-bold"><i class="fa fa-check-circle fa-1xl text-white"></i><?= " " . $_SESSION['systemname'] ?></p>
                        <p class="text-white" style="margin-top: -1rem; margin-left: 1.5rem;"><?= $_SESSION['semester'] ?> Semester A.Y. <?= $_SESSION['acadyear'] ?></p>
                    </div>
                </div>
            </div>
            <div class="container col-lg-6 col-sm-12 bg-white">
                <div class="row">
                    <p class="mt-lg-5 pt-5 mt-md-1 mb-lg-5 mb-sm-3 fs-5 w-100 text-center">Hello there, human!</p>
                    <form class="" method="post" action="">
                        <div class="row justify-content-center mt-lg-3 mt-md-2">
                            <div class="col-lg-11">
                                <div class="form-group d-flex align-items-center mb-3">
                                    <i class="fa fa-user fa-2x text-<?= $theme ?>"></i>
                                    <input type="text" name="code" id="id" autocomplete="off" value="<?= get_var('code') ?>" class="form-control" placeholder="Username" style="margin-left: .5rem;" />

                                </div>
                                <div class="form-group d-flex align-items-center">
                                    <i class="fa fa-lock fa-2x text-<?= $theme ?>"></i>
                                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" style="margin-left: .5rem;" />

                                </div>
                                <button name="" class="btn btn-<?= $theme ?> col-12 mt-3" type="submit">Login</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>