<?php include 'partials/adminpage_header.php'; ?>
<h3><a href="<?= ROOT ?>/adminpage/questions"><i class="fa fa-arrow-left text-secondary"></i></a> Manage Questionnaires</h3>
<div class="container mt-4 shadow p-3 rounded">
    <div class="">
        <div class="text-center mb-2">
            <h4>A.Y.<?= $acads[0]->academic_year ?></h4>
            <h5> Semester <?= $acads[0]->semester ?></h5>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
                <!-- Add button -->
                <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addQModal">Add</button>
                <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
            </div>
        </div>
        <div class="col-md-12 table-responsive">
            <?php foreach ($rows2 as $criterion) { ?>
                <table class="table table-hover table-striped">
                    <thead class="table table-dark">
                        <tr>
                            <th class="w-75 h4 p-3"><?= $criterion->criteria; ?></th>
                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                <th class="p-3"><?= $i; ?></th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($rows) && $rows != null) { ?>
                            <?php foreach ($rows as $question) { ?>
                                <?php if ($criterion->id == $question->criterias_id) { ?>
                                    <tr>
                                        <td class="p-3"><?= $question->question; ?></td> <!-- Access question property directly -->
                                        
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <td class="p-3"><input type="radio" class="form-check-input" name="question_id" value="<?= $i; ?>"></td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6">
                                    <p class="mt-3 text-center">No questions found for this criterion</p>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>


<!--Add Questions Modal -->
<div class="modal fade" id="addQModal" tabindex="-1" aria-labelledby="addQModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="classModalLabel">Add New Question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="criteria" class="form-label">Criteria</label>
                        <select id="dSelect" class="form-select" required name="criterias_id" value="">
                            <?php foreach ($rows2 as $option) { ?>
                                <option value="<?= $option->id ?>" <?= get_selected('criteria', $option->id) ?>><?= $option->criteria ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Question:</label>
                        <textarea name="question" id="question" cols="30" rows="4" class="form-control" required=""></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary d-flex justify-content-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/adminpage_footer.php'; ?>