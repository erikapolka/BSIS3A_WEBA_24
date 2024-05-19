<?php include "partials/studentpage_header.php"; ?>
<a class="btn" data-toggle="modal" data-target="#confirmbackModal"><i class="fa fa-arrow-left text-secondary h4"></i></a>

<div class="p-5 mx-5 border shadow rounded">
    <div>
        <form method="POST" action="">

            <!-- academic -->
            <div class="text-center">
                <p class="h5"><strong><?= $_SESSION['schoolname'] ?></strong></p>
                <p>A.Y. <?= $acads_default->academic_year ?> <br>
                    Semester <?= $acads_default->semester ?></p>
            </div>
            <input type="hidden" name="academic_id" value="<?= $acads_default->id; ?>">

            <!-- stud_id -->
            <p>Student ID: <?= $student->code ?></p>
            <p>Name: <?= $student->stud_fname . ' ' . $student->stud_lname ?></p>
            <input type="hidden" name="stud_id" value="<?= $student->id; ?>">

            <!-- class -->
            <p>Course, Year&Sec: <?= $sections->class_course . '-' . $sections->class_level .  $sections->class_section ?></p>
            <input type="hidden" name="class_id" value="<?= $sections->id; ?>">

            <!-- subjects -->
            <p>Subjects: 
                <?php 
                $subjectCodes = [];
                foreach ($handles as $handle) {
                    foreach ($subjects as $subject) {
                        if ($subject->id == $handle->subject_id) {
                            $subjectCodes[] = $subject->code;
                        }
                    }
                }
                echo implode(", ", $subjectCodes);
                ?>
            </p>
            <?php foreach ($handles as $handle) { ?>
                <input type="hidden" name="subject_id[]" value="<?= $handle->subject_id ?>">
            <?php } ?>

            <!-- instructor -->
            <p>Instructor: <?= $facultys->faculty_fname . ' ' . $facultys->faculty_lname ?></p>
            <input type="hidden" name="faculty_id" value='<?= $facultys->id; ?>'>

            <div class="text-center mt-5">
                <p>(5)-Always, (4)-Most of the time, (3)-Sometimes, (2)-Once in a while, (1)-Rarely</p>
            </div>
            <?php foreach ($rows2 as $criterion) { ?>
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th class="w-75 h4 p-3"><?= $criterion->criteria ?></th>
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <th class="p-3"><?= $i; ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $question) { ?>
                            <?php if ($criterion->id == $question->criterias_id) { ?>
                                <tr>
                                    <td class="p-3"><?= $question->question ?></td>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <td class="p-3">
                                            <input required type="radio" class="form-check-input" name="question_<?= $question->id; ?>" value="<?= $i; ?>">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
    </div>
    <div class="d-flex justify-content-center align-items-center p-5">
        <div>
            <div>
                <h5>Comment about the instructor:</h5>
            </div>
            <div><textarea required name="comment" id="" maxlength="100" rows="4" cols="25"></textarea></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    </form>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmbackModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Back to Instructors</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to perform this action?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="<?= ROOT ?>/evaluationpage/instructors?id=<?= $_SESSION['TOKEN'] ?>" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>

<?php include "partials/studentpage_footer.php"; ?>
