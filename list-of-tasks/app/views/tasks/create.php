<?php include "../app/views/partials/header.php"; ?>
<style>
    label {
        font-weight: bold;
    }
</style>
<div class="col col-12 mt-5">
    <div class="h1 text-center">A d d T a s k </div>
</div>

<!-- Form for adding tasks -->
<div class="row">
    <div class="d-flex justify-content-center">
        <form method="post" class="">
            <div class="mb-3">
                <label for="taskName" class="form-label">Name</label>
                <input type="text" class="form-control" id="taskName" name="task_name" required>
            </div>
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Description</label>
                <textarea class="form-control" id="taskDescription" name="task_description" maxlength="50" required></textarea>
            </div>
            <div class="mb-3">
                <label for="taskStatus" class="form-label">Status</label>
                <select class="form-select" id="taskStatus" name="task_status" required>
                    <option value="To Do">To Do</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Done">Done</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="taskDue" class="form-label">Due</label>
                <input type="date" class="form-control" id="taskDue" name="task_due" required>
            </div>
            <div class="d-flex justify-content-around">
                <a href="<?= ROOT ?>/tasks/index" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php include "../app/views/partials/footer.php"; ?>