<?php include "partials/facultypage_header.php"; ?>
<div class="d-flex justify-content-start align-items-center mb-4">
<a class="btn border mx-3" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-home text-secondary h4"></i></a>
<h3>Results</h3>
</div>

<div class="p-3 mx-5 border rounded col-4">
    <form method="POST" action="">
        <div class="mb-3">
            <label for="section_id" class="form-label">Section:</label>
            <select id="dSelect" name="section_id" class="form-select" required onchange="this.form.submit()">
                <option value="">Search</option>
                <?php if (isset($handledSections) && !empty($handledSections)) : ?>
                    <?php foreach ($handledSections as $section) : ?>
                        <option value="<?= $section->id ?>" <?= (isset($_POST['section_id']) && $_POST['section_id'] == $section->id) ? 'selected' : '' ?>>
                            <?= $section->class_course . '-' . $section->class_level . $section->class_section ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="show_comments" class="form-label">Show Comments:</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="show_comments" name="show_comments" <?= isset($_POST['show_comments']) ? 'checked' : '' ?> onchange="this.form.submit()">
            </div>
        </div>
        <input type="hidden" name="academic_id" value="<?= $acads_default->id ?>">
    </form>
</div>


<div class="p-5 mx-5 border shadow rounded">
    <div class="container">
        <div class="text-center">
            <p class="h5"><strong><?= $_SESSION['schoolname'] ?></strong></p>
            <p>A.Y. <?= $acads_default->academic_year ?> <br>
                Semester <?= $acads_default->semester ?></p>
        </div>
        
        <?php if ($evaluationResults != null) { ?>
            <div>
                <p>ID:
                    <strong><?= $facultyInfo->code ?></strong> <br>
                    Name:
                    <strong><?= $facultyInfo->faculty_fname . ' ' . $facultyInfo->faculty_lname ?></strong><br>
                    Subject:
                    <strong><?php 
                    $subjectCodes = [];
                    foreach ($handles as $handle) {
                        foreach ($subjects as $subject) {
                            if ($subject->id == $handle->subject_id) {
                                $subjectCodes[] = $subject->code;
                            }
                        }
                    }
                    echo implode(", ", $subjectCodes);
                    ?></strong><br>
                    Course, Yr.&Sec.: <strong><?= $sectionInfo->class_course . '-' . $sectionInfo->class_level . $sectionInfo->class_section ?></strong><br>
                    Total Evaluators:
                    <strong><?= $totalEvaluators . '/' . $totalStudent ?></strong></p>
            </div>
            <div class="text-center mt-5">
                <p>(5)-Always, (4)-Most of the time, (3)-Sometimes, (2)-Once in a while, (1)-Rarely</p>
            </div>

            <?php foreach ($criteria as $criterion) { ?>
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
                        <?php foreach ($questions as $question) { ?>
                            <?php if ($criterion->id == $question->criterias_id) { ?>
                                <tr>
                                    <td class="p-3"><?= $question->question ?></td>
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <td class="p-3">
                                            <?php
                                            $rate_count = 0;
                                            foreach ($evaluationResults as $result) {
                                                if ($result->question_id == $question->id && $result->rate == $i) {
                                                    $rate_count = $result->rate_count;
                                                }
                                            }
                                            $percentage = $totalEvaluators > 0 ? round(($rate_count / $totalEvaluators) * 100, 1) . '%' : '0%';
                                            echo $percentage;
                                            ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        <?php } else { ?>
            <div class="text-center">
                <h5>No record found</h5>
            </div>
        <?php } ?>
    </div>
</div>

<?php if ((isset($_POST['show_comments']) && $_POST['show_comments']) && !empty($comments)) { ?>
    <div class="p-5 mx-5 border shadow rounded mt-3">
        <h4>Comments</h4>
        <div class="overflow-auto" style="max-height: 200px;">
            <?php foreach ($comments as $comment) { ?>
                <div class="mb-2">
                    <p class="border rounded"><?= htmlspecialchars($comment->comment) ?></p>
                    
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>


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
                <a href="<?= ROOT ?>/facultypage/home" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>

<?php include "partials/facultypage_footer.php"; ?>
