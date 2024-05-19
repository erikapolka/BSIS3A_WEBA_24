<?php include 'partials/adminpage_header.php';

foreach ($rows as $item) {
?>

    <h3><a href="<?= ROOT ?>/adminpage/facultylist"><i class="fa fa-arrow-left text-secondary"></i></a> <?= $item->faculty_fname . ' ' . $item->faculty_lname ?> - Faculty Member</h3>
    <?php if (isset($_SESSION["info"])) : ?>
        <?php echo ($_SESSION["info"]) ?>
        <?php unset($_SESSION["info"]); // Clear the error message from session 
        ?>
    <?php endif; ?>

    <div class="row mt-4 shadow p-3 rounded">
        <div class="col-lg-7">
            <!-- Form for editing faculty -->
            <h5>Personal Informations</h5>
            <form action="" method="post">
                <div class="row">
                    <div class="form-group col-5">
                        <label for="faculty_id"><strong>ID</strong></label>
                        <input type="text" value="<?= $item->code ?>" class="form-control mb-3" id="faculty_id" name="code" placeholder="24-00000" required autocomplete="off">
                    </div>
                </div>

                <div class="form-group col-lg-10 mb-2 col-sm-12">
                    <label for="first_name"><strong>First Name</strong></label>
                    <input type="text" value="<?= $item->faculty_fname ?>" class="form-control" id="first_name" name="faculty_fname" required autocomplete="off">
                </div>
                <div class="form-group col-lg-10 col-sm-12">
                    <label for="middle_name"><strong>Middle Name</strong></label>
                    <input type="text" value="<?= $item->faculty_mname ?>" class="form-control" id="middle_name" name="faculty_mname" autocomplete="off">
                </div>
                <div class="form-group col-lg-10 col-sm-12">
                    <label for="last_name"><strong>Last Name</strong></label>
                    <input type="text" value="<?= $item->faculty_lname ?>" class="form-control" id="last_name" name="faculty_lname" required autocomplete="off">
                </div>

                <div class="row mb-3">
                    <div class="form-group col-lg-10 col-sm-12">
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
        <div class="col-1 d-flex pb-5 hidden-sm">
            <div class="vr"></div>
        </div>
        <div class="col-lg-4">
            <div class="d-flex justify-content-center">
                <h5>Handled Subject/s</h5>
            </div>
            <div class="col-md-12 mb-2">
                <?php if (!empty($handles)) { ?>
                    <div id="accordion" class="table-responsive">
                        <?php foreach ($subjects as $subject) { ?>
                            <?php
                            // Check if the current subject is selected by the faculty
                            $selected = false;
                            foreach ($handles as $handle) {
                                if ($subject->id == $handle->subject_id) {
                                    $selected = true;
                                    break;
                                }
                            }
                            // Display the subject only if it's selected by the faculty
                            if ($selected) {
                            ?>
                                <div class="card">
                                    <div class="card-header" id="heading<?= $subject->id ?>">
                                        <h5 class="mb-0">
                                            <button class="btn dropdown-toggle" data-toggle="collapse" data-target="#collapse<?= $subject->id ?>" aria-expanded="true" aria-controls="collapse<?= $subject->id ?>">
                                                <?= $subject->code; ?>
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse<?= $subject->id ?>" class="collapse" aria-labelledby="heading<?= $subject->id ?>" data-parent="#accordion">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                <?php
                                                // Iterate over the handles to find sections for this subject
                                                $sectionsFound = false;
                                                foreach ($handles as $handle) {
                                                    if ($subject->id == $handle->subject_id) {
                                                        $sectionsFound = true;
                                                ?>
                                                        <li class="list-group-item"><div class="d-flex
                                                        justify-content-between align-items-center"><?= $class[$handle->section_id] ?><form method="post" action="">
                                                                <input type="hidden" name="id" value="<?= $handle->id ?>">
                                                                <button type="submit" name="deleteFacSubject" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                            </form></div>
                                                        </li>
                                                    <?php }
                                                }
                                                if (!$sectionsFound) { ?>
                                                    <li class="list-group-item">No sections found for this subject</li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } else { ?>

                    <p class="mt-3 text-center">No record found</p>

                <?php } ?>
            </div>


            <div class="d-flex justify-content-center"><button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addFacultySubjectModal">Add</button></div>
        </div>


    </div>

<?php } ?>

<!-- Modal -->
<div class="modal fade" id="addFacultySubjectModal" tabindex="-1" aria-labelledby="addFacultySubjectModalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFacultySubjectModalModalLabel">Add Handled Subject/s</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">

                    <div class="mb-3">
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="subject"><strong>Subject:</strong></label>
                            <select id="dSelect" class="form-select" required name="subject_id" value="<?= get_var('subject_id') ?>">
                                <option value="">Search</option>
                                <?php foreach ($subjects as $subject) { ?>
                                    <option value="<?= $subject->id ?>" <?php if (get_var('subject_id') == $subject->id) echo "selected"; ?>><?= $subject->code ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4 col-sm-12">
                            <label for="section"><strong>Sections:</strong></label>
                            <select multiple id="dSelectSection" class="form-select" required name="section_id[]" value="<?= get_var('section_id') ?>">
                                <option value="">Search</option>
                                <?php foreach ($sections as $option) { ?>
                                    <option value="<?= $option->id ?>" <?php if (get_var('section_id') == $option->id) echo "selected"; ?>><?= $option->class_course . "-" . $option->class_level . $option->class_section ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="addFacultySubject" class="btn btn-primary d-flex justify-content-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/adminpage_footer.php'; ?>