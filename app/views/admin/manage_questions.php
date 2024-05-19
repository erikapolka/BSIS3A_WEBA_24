<?php include 'partials/adminpage_header.php'; ?>
<h3><a href="<?= ROOT ?>/adminpage/questions"><i class="fa fa-arrow-left text-secondary"></i></a> Manage Questionnaires</h3>
<div class="container mt-4 shadow p-3 rounded">
    <div class="">
        <div class="text-center mb-2">
            <h4>A.Y.<?= $acads->academic_year ?></h4>
            <h5> Semester <?= $acads->semester ?></h5>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
                <!-- Add button -->
                <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addQModal">Add</button>
            </div>
        </div>
        <div class="text-center mt-5">
                <p>(5)-Always, (4)-Most of the time, (3)-Sometimes, (2)-Once in a while, (1)-Rarely</p>
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
                            <th class="p-3">Actions</th> <!-- Add Actions column for edit button -->
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
                                        <td class="p-3">
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editQModal<?= $question->id ?>"><i class="fa fa-pen"></i></button> <!-- Edit button trigger modal -->
                                        </td>
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
                                <option value="<?= $option->id ?>" <?= (isset($_POST['criterias_id']) && $_POST['criterias_id'] == $option->id) ? 'selected' : '' ?>><?= $option->criteria ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Question:</label>
                        <textarea name="question" id="question" maxlength="300" cols="30" rows="4" class="form-control" required=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex justify-content-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Questions Modal -->
<?php if ($rows != null) {
    foreach ($rows as $question) { ?>
    <div class="modal fade" id="editQModal<?= $question->id ?>" tabindex="-1" aria-labelledby="editQModalLabel<?= $question->id ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editQModalLabel<?= $question->id ?>">Edit Question</h5>
                    <form method="post" action="<?= ROOT ?>/adminpage/deleterecord">
                    <input type="hidden" name="redirectPage" value="managequestions?id=<?=$id?>">
                        <input type="hidden" name="table_name" value="Question">
                        <input type="hidden" name="id" value="<?= $question->id ?>">
                        <button type="submit" name="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="criteria" class="form-label">Criteria</label>
                            <select id="" class="form-select" required name="criterias_id" value="">
                                <?php foreach ($rows2 as $option) { ?>
                                    <option value="<?= $option->id ?>" <?= ($question->criterias_id == $option->id) ? 'selected' : '' ?>><?= $option->criteria ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Question:</label>
                            <textarea name="question" id="question" maxlength="300" cols="30" rows="4" class="form-control" required=""><?= $question->question ?></textarea>
                        </div>
                        <input type="hidden" name="acads_id" value="<?= $acads->id ?>">
                        <input type="hidden" name="id" value="<?= $question->id ?>">
                        <div class="modal-footer">
                <a href="<?= ROOT ?>/adminpage/managequestions?id=<?= $acads->id ?>" type="button" class="btn btn-secondary">Close</a>
                    <button type="submit" name="updateQuestion" class="btn btn-primary d-flex justify-content-end">Save Changes</button>
                    
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }
} ?>

<?php include 'partials/adminpage_footer.php'; ?>
