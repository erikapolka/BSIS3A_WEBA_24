<?php include "../app/views/partials/header.php"; ?>
<!-- Display alert message if any -->
<?php
if (isset($_SESSION["notif"])) : ?>
    <?php echo ($_SESSION["notif"]) ?>
    <?php unset($_SESSION["notif"]);
    ?>
<?php endif; ?>
<div class="row">
    <div class="col col-12 mt-5">
        <div class="h1 text-center">T a s k s</div>
    </div>
    <div class="col col-12">
        <div class="container mt-5">
            <div class="row mb-3">
                <h2 class="col-10">Task List</h2>
                <a href="<?= ROOT ?>/tasks/create" class="btn btn-primary col-2 fs-5"><i class="fa-solid fa-plus"></i> Create</a>
            </div>
            <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-center">
                    <tr>

                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($rows != null) { ?>
                        <?php foreach ($rows as $item) { ?>
                            <tr>

                                <td><?= $item->task_name ?></td>
                                <td><?= $item->task_description ?></td>
                                <td style="font-weight: bold;
                            color: 
            <?php
                            switch ($item->task_status) {
                                case 'To Do':
                                    echo 'skyblue';
                                    break;
                                case 'Done':
                                    echo 'green';
                                    break;
                                case 'In Progress':
                                    echo 'orange';
                                    break;
                                case 'Canceled':
                                    echo 'red';
                                    break;
                                default:
                                    echo 'black'; // Default color if status doesn't match any case
                            }
            ?>
        "><?= $item->task_status ?></td>
                                <td><?= date('l, F j, Y', strtotime($item->task_due)) ?></td>
                                <td class="">
                                    <a href="<?= ROOT ?>/tasks/edit/<?= $item->id ?>" class="btn btn-success mx-1"><i class="fa-solid fa-pen"></i> Edit</a>
                                    <a href="<?= ROOT ?>/tasks/delete/<?= $item->id ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">
                                <h5 class="mt-3">No record found.</h3>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<?php include "../app/views/partials/footer.php"; ?>