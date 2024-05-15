<?php include 'partials/adminpage_header.php';

foreach ($rows as $item) {



?>

    <h3><a href="<?= ROOT ?>/adminpage/facultylist"><i class="fa fa-arrow-left text-secondary"></i></a> <?= $item->faculty_fname . ' ' . $item->faculty_lname ?> - Faculty Member</h3>


    <div class="row mt-4 shadow p-3 rounded">
        <!-- Form for editing faculty -->
        <form action="" method="post">
            <div class="row">
                <div class="form-group col-4">
                    <label for="faculty_id"><strong>ID</strong></label>
                    <input type="text" value="<?= $item->faculty_code ?>" class="form-control mb-3" id="faculty_id" name="faculty_code" placeholder="MA12345678" required autocomplete="off">
                </div>
                <div class="form-group col-8">
                    <?php if (isset($_SESSION["info"])) : ?>
                        <?php echo ($_SESSION["info"]) ?>
                        <?php unset($_SESSION["info"]); // Clear the error message from session 
                        ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row d-flex justify-content-start mb-3">
                <div class="form-group col-lg-4 mb-2 col-sm-12">
                    <label for="first_name"><strong>First Name</strong></label>
                    <input type="text" value="<?= $item->faculty_fname ?>" class="form-control" id="first_name" name="faculty_fname" required autocomplete="off">
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label for="middle_name"><strong>Middle Name</strong></label>
                    <input type="text" value="<?= $item->faculty_mname ?>" class="form-control" id="middle_name" name="faculty_mname" autocomplete="off">
                </div>
                <div class="form-group col-lg-4 col-sm-12">
                    <label for="last_name"><strong>Last Name</strong></label>
                    <input type="text" value="<?= $item->faculty_lname ?>" class="form-control" id="last_name" name="faculty_lname" required autocomplete="off">
                </div>
            </div>



            <div class="row mb-3">


                <div class="form-group col-lg-8 col-sm-12">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" value="<?= $item->faculty_email ?>" class="form-control" id="email" name="faculty_email" placeholder="sample@email.com" required autocomplete="off">
                </div>
            </div>
            <input type="hidden" value="<?= $item->id ?>" name="id">
            <div class="d-flex justify-content-center mb-2"><button type="submit" class="btn btn-primary ">Save Changes</button></div>
        </form>

        <form action="" method="post">
            <input type="hidden" value="<?= $item->id ?>" name="id">
            <div class="d-flex justify-content-center mb-2"><button type="submit" name="resetPass" class="btn btn-secondary">Reset Password</button></div>
        </form>
    

    <form action="" method="post">
        <input type="hidden" value="<?= $item->id ?>" name="id">
        <div class="d-flex justify-content-center"><button type="submit" name="delete" class="btn btn-danger">Delete</button></div>
    </form>
    </div>
    </div>

<?php }
include 'partials/adminpage_footer.php'; ?>