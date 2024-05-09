<?php include 'partials/adminpage_header.php'; ?>

<h3>Class List</h3>
<div class="form-group">
    <?php if (isset($_SESSION["info"])) : ?>
        <?php echo ($_SESSION["info"]) ?>
        <?php unset($_SESSION["info"]);
        ?>
    <?php endif; ?>
</div>
<div class="container mt-4 shadow p-3 rounded">
    <div class="row">
        <div class="col-6 col-sm-6">
            <!-- Search bar -->

            <form action="" method="post">
                <div class="row">
                    <div class="col-8"><input type="text" value="<?= get_var('searchBox') ?>" class="form-control mb-2" name="searchBox" placeholder="Search"></div>
                    <div class="col-1"><button type="submit" name="searchClass" class="btn btn-secondary"><i class="fa fa-search"></i></button></div>
                </div>
            </form>

        </div>
        <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
            <!-- Add button -->
            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#classModal">Add</button>
            <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-responsive">
            <!-- Bootstrap table -->
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th class="w-75">Class</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- Table rows -->
                    <?php if ($rows != null) { ?>
                        <?php

                        foreach ($rows as $item) { ?>
                            <tr>
                                <td class="py-2 px-2 text-center"><?= $item->class_course . "-" . $item->class_level . $item->class_section ?></td>
                                <td class="d-flex justify-content-center py-2"><a href='<?= ROOT ?>/adminpage/editstudent?id=<?= $item->id ?>' class="btn btn-success">
                                        <i class="fa fa-pen"></i>
                                    </a></td>
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


    <!-- Modal -->
    <div class="modal fade" id="classModal" tabindex="-1" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classModalLabel">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <div class="mb-3">
                            <label for="course" class="form-label">Course:</label>
                            <input type="text" id="course" name="class_course" class="form-control" placeholder="BSIS" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Year Level:</label>
                            <input type="text" id="level" name="class_level" class="form-control" placeholder="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="section" class="form-label">Section:</label>
                            <input type="text" id="section" name="class_section" class="form-control" placeholder="A" required>
                        </div>
                        <button type="submit" class="btn btn-primary d-flex justify-content-end">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <?php include 'partials/adminpage_footer.php'; ?>