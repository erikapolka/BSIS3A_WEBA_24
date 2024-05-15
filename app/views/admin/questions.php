<?php include 'partials/adminpage_header.php'; ?>

<h3>Questionnaires</h3>
<div class="form-group">
    <?php if (isset($_SESSION["info"])) : ?>
        <?php echo ($_SESSION["info"]) ?>
        <?php unset($_SESSION["info"]);
        ?>
    <?php endif; ?>
</div>


<div class="container mt-4 shadow p-3 rounded">
    <div class="row d-flex justify-content-end">
        <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
            <!-- Add button -->
            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#acadYearModal">Add</button>
            <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <!-- Bootstrap table -->
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead class="table table-dark">
                    <tr class="text-center">
                        <th>A.Y.</th>
                        <th>Semester</th>
                        <th>Questions</th>
                        <th>Answered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- Table rows -->
                    <?php if ($rows != null) { ?>
                        <?php foreach ($rows as $item) { ?>
                            <tr class="text-center">
                                <td class="py-2 px-2"><?= $item->academic_year ?></td>
                                <td class="py-2 px-2"><?= $item->semester ?></td>
                                <td class="px-5 py-2">
                                    <?php
                                    if (!empty($questions)) {
                                    $questionCount = 0;
                                    foreach ($questions as $question) {
                                        if ($question->acads_id == $item->id) {
                                            $questionCount++;
                                        }
                                        
                                    }
                                    echo $questionCount;}
                                    else{
                                        echo '0';
                                    }
                                    ?>
                                </td>
                                <td class="py-2">0</td>
                                <td class="d-flex justify-content-center py-2">
                                    <a href="<?= ROOT ?>/adminpage/managequestions?id=<?= $item->id ?>" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="5">
                                <p class="mt-3 text-center">No record found</p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>

    <!--  Add Academic Modal -->
    <div class="modal fade" id="acadYearModal" tabindex="-1" aria-labelledby="acadyYearModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acadYearModalLabel">Add New A.Y. and Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="academicYear" class="form-label">Academic Year:</label>
                            <input type="text" name="academic_year" class="form-control" placeholder="2023-2024" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester:</label>
                            <input type="text" name="semester" class="form-control" placeholder="1" required>
                        </div>
                        <input type="hidden" name="ay_default" value="0">
                        <input type="hidden" name="status" value="0">
                        <button type="submit" class="btn btn-primary d-flex justify-content-end">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML markup -->
    <div class="modal fade" id="acadModal" tabindex="-1" aria-labelledby="acadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acadModalLabel">Edit Academic Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php foreach ($rows2 as $row) { ?>


                        <form method="post">
                            <div class="mb-3">
                                <label for="academicYear" class="form-label">Academic Year:</label>
                                <input type="text" name="academic_year" class="form-control" placeholder="2023-2024" value="<?= $row->academic_year ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester:</label>
                                <input type="text" name="semester" class="form-control" value="<?= $row->semester ?>" placeholder="1" required>
                            </div>
                            <div class="mb-3">
                                <label for="ay_default" class="form-label">System Default</label>
                                <select class="form-select" name="ay_default" required>
                                    <option value="0" <?php if ($row->ay_default == 0) echo "selected" ?>>No</option>
                                    <option value="1" <?php if ($row->ay_default == 1) echo "selected" ?>>Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="0" <?php if ($row->status == 0) echo "selected" ?>>Pending</option>
                                    <option value="1" <?php if ($row->status == 1) echo "selected" ?>>Ongoing</option>
                                    <option value="2" <?php if ($row->status == 2) echo "selected" ?>>Closed</option>
                                </select>
                            </div>
                            <input type="hidden" name="id" value="<?= $row->id ?>">

                        <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="updateAcad" class="btn btn-primary d-flex justify-content-end">Save Changes</button>

                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to show the modal -->
    <?php if (!empty($rows2)) : ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById("acadModal"));
                myModal.show();
            });
        </script>
    <?php endif; ?>


    <?php include 'partials/adminpage_footer.php'; ?>