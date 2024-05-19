<?php include "partials/studentpage_header.php"; ?>

<a class="btn border" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-home text-secondary h4"></i></a>
<div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
    <div class="p-5 border rounded shadow">
        <div>
            <p class="h5 text-center mb-4">Instructors</p>
            
        </div>
        <div class="btn-group-vertical" role="group" aria-label="Vertical button group">

            <?php if ($handles != null) { ?>

                <?php foreach ($facultys as $facultyId => $fac) {
                    $buttonId = 'button_' . $facultyId;
                    $isDisabled = $disabledStatus[$facultyId];
                ?>
                    <button id="<?= $buttonId ?>" <?= $isDisabled ?> type="button" class="btn border btn-link">
                        <a href="<?= ROOT ?>/evaluationpage/take?id=<?= $_SESSION['TOKEN'] ?>&fid=<?= $fac->token ?>">
                            <?= $fac->faculty_fname . ' ' . $fac->faculty_lname ?>
                            <?php 
                            $subjectsHandled = [];
                            foreach ($handles as $handle) {
                                if ($handle->faculty_id == $facultyId) {
                                    foreach ($subjects as $subject) {
                                        if ($subject->id == $handle->subject_id) {
                                            $subjectsHandled[] = $subject->code;
                                        }
                                    }
                                }
                            }
                            echo '(' . implode(', ', $subjectsHandled) . ')';
                            ?>
                        </a>
                        <?php if ($isDisabled == 'disabled') echo '<i class="fa fa-circle-check text-success"></i>' ?>
                    </button>
                <?php } ?>

            </div>
            <?php } else { ?>
                <div></div>
                <div class="h5">
                    <p>not available</p>
                </div>
            <?php } ?>
        </div>
    </div>


<!-- Confirm Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform this action?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="<?= ROOT ?>/evaluationpage/home" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>

<?php include "partials/studentpage_footer.php"; ?>
