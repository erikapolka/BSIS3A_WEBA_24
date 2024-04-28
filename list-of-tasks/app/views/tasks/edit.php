<?php include "../app/views/partials/header.php"; ?>
<style>
    label {
        font-weight: bold;
    }
</style>
<div class="col col-12 mt-5">
    <div class="h1 text-center">E d i t T a s k </div>
</div>

<!-- Form for adding tasks -->
<div class="row">
    <div class="d-flex justify-content-center">
        <form method="post" class="">
            <div class="mb-3">
                <label for="taskName" class="form-label">Name</label>
                <input type="text" class="form-control" id="taskName" name="task_name" value="<?= $rows->task_name ?>" required>
            </div>
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Description</label>
                <textarea class="form-control" id="taskDescription" name="task_description" maxlength="50" required><?= $rows->task_description ?></textarea>
            </div>
            <div class="mb-3">
                <label for="taskStatus" class="form-label">Status</label>
                <select class="form-select" id="taskStatus" name="task_status" required>
                    <option value="To Do" <?php if ($rows->task_status == "To Do") echo 'selected' ?>>To Do</option>
                    <option value="In Progress" <?php if ($rows->task_status == "In Progress") echo 'selected' ?>>In Progress</option>
                    <option value="Canceled" <?php if ($rows->task_status == "Canceled") echo 'selected' ?>>Canceled</option>
                    <option value="Done" <?php if ($rows->task_status == "Done") echo 'selected' ?>>Done</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="taskDue" class="form-label">Due</label>
                <input type="date" class="form-control" id="taskDue" name="task_due" value="<?= $rows->task_due ?>" required>
            </div>
            <div class="d-flex justify-content-around">
                <a href="<?= ROOT ?>/tasks/index" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php include "../app/views/partials/footer.php"; ?>