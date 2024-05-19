<?php include "partials/adminpage_header.php"; ?>

<h3>Results</h3>
<div class="p-3 mx-5 border rounded col-4">
    <form method="POST" action="">
        <div class="mb-3">
            <label for="faculty_id" class="form-label">Instructor:</label>
            <select id="dSelect" name="faculty_id" class="form-select" required onchange="this.form.submit()">
                <option value="">Search</option>
                <?php foreach ($faculties as $faculty) : ?>
                    <option value="<?= $faculty->id ?>" <?= (isset($_POST['faculty_id']) && $_POST['faculty_id'] == $faculty->id) ? 'selected' : '' ?>>
                        <?= $faculty->faculty_fname . ' ' . $faculty->faculty_lname ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="section_id" class="form-label">Section:</label>
            <select id="dSelectSection" name="section_id" class="form-select" required onchange="this.form.submit()">
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

<?php if ((isset($_POST['section_id']) && !empty($_POST['section_id']) && $evaluationResults != null)) { ?>
    <div class="d-flex justify-content-end mx-5">
        <form method="POST" action="<?= ROOT ?>/adminpage/report">
            <input type="hidden" name="faculty_id" value="<?= $_POST['faculty_id'] ?>">
            <input type="hidden" name="section_id" value="<?= $_POST['section_id'] ?>">
            <input type="hidden" name="academic_id" value="<?= $_POST['academic_id'] ?>">
            <button class="btn btn-primary" type="submit">Generate PDF <i class="fa fa-print mx-2"></i></button>
        </form>
    </div>
<?php } ?>

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

<?php include "partials/adminpage_footer.php"; ?>
