<?php include 'partials/adminpage_header.php'; ?>


<h2>Criteria List</h2>
<div class="container mt-4 shadow p-3 rounded">

    <div class="row">
        <div class="col-6 col-sm-6">
            <!-- Search bar -->

        </div>
        <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
            <!-- Add button -->
            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addCriteriaModal">Add</button>
            <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 table-responsive">
            <!-- Bootstrap table -->
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>Order By</th>
                        <th>Criteria</th>
                        <th>Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <!-- Table rows -->
                    <?php if ($rows != null) { ?>
                        <?php

                        foreach ($rows as $item) { ?>
                            <tr>
                                <td class="py-2 px-2 text-center"><?= $item->order_by ?></td>
                                <td class="py-2 px-2 text-center col-8"><?= $item->criteria ?></td>
                                <td class="d-flex justify-content-center py-2">
                                    <form method="post" action="">
                                        <input type="hidden" name="id" value="<?= $item->id ?>">
                                        <button type="submit" name="editCriteria" class="btn btn-success"><i class="fa fa-pen"></i></button>
                                    </form>
                                </td>
                                <td class="py-2 px-2 text-center">
                                    <form method="post" action="">

                                        <input type="hidden" name="id" value="<?= $item->id ?>">
                                        <input type="hidden" name="order_by" value="<?= $item->order_by ?>">
                                        <div class="">
                                            <?php if ($item->order_by != 1) : ?>
                                                <button type="submit" name="sortUp" class="btn"><i class="fa fa-arrow-up text-secondary"></i></button>
                                            <?php endif; ?>

                                            <?php if ($item->order_by != $max[0]->order_by) : ?>
                                                <button type="submit" name="sortDown" class="btn"><i class="fa fa-arrow-down text-secondary"></i></button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
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
</div>


<!-- Modal -->
<div class="modal fade" id="addCriteriaModal" tabindex="-1" aria-labelledby="addCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCriteriaModalLabel">Add New Criteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">

                    <div class="mb-3">
                        <label for="criteria" class="form-label">Criteria:</label>
                        <input type="text" id="criteria" name="criteria" class="form-control" placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex justify-content-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="editCriteriaModal" tabindex="-1" aria-labelledby="editCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php foreach ($rows2 as $row) { ?>
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="editCriteriaModalLabel">Edit Criteria</h5>
                    <form method="post" action="<?= ROOT ?>/adminpage/deleterecord">
                    <input type="hidden" name="redirectPage" value="criterialist">
                        <input type="hidden" name="table_name" value="Criteria">
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                        <button type="submit" name="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Criteria:</label>
                            <input type="text" name="criteria" class="form-control" value="<?= $row->criteria ?>" placeholder="" required>
                        </div>
                        <input type="hidden" name="id" value="<?= $row->id ?>">

                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <a href="<?= ROOT ?>/adminpage/criteriaList" type="button" class="btn btn-secondary">Close</a>
                    <button type="submit" name="updateCriteria" class="btn btn-primary d-flex justify-content-end">Save Changes</button>

                </div>
                </form>
        </div>
    </div>
</div>

<!-- JavaScript to show the modal -->
<?php if (!empty($rows2)) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById("editCriteriaModal"));
            myModal.show();
        });
    </script>
<?php endif; ?>

<?php include 'partials/adminpage_footer.php'; ?>