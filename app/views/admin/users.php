<?php include 'partials/adminpage_header.php'; ?>

<h3>Admin List</h3>
<div class="form-group">
  <?php if (isset($_SESSION["info"])) : ?>
    <?php echo ($_SESSION["info"]) ?>
    <?php unset($_SESSION["info"]); ?>
  <?php endif; ?>
</div>
<!-- Edit  Modal -->
<div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAdminModalLabel">Edit Admin</h5>
          <form action="" method="post">
            <input type="hidden" value="<?= $adminInfo->id ?>" name="id">
            <button type="submit" name="resetPass" class="btn btn-secondary btn-sm">Reset Password</button>
          </form>
          <form method="post" action="">
            <input type="hidden" name="id" value="<?= $adminInfo->id ?>">
            <button type="submit" name="deleteAdmin" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
          </form>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="mb-3">
              <label for="code" class="form-label">ID:</label>
              <input type="text" id="code" name="code" class="form-control" placeholder="admin1" value="<?= $adminInfo->code ?>" required>
            </div>
            <div class="mb-3">
              <label for="admin_fname" class="form-label">First Name:</label>
              <input type="text" id="admin_fname" name="admin_fname" class="form-control" placeholder="Juan" value="<?= $adminInfo->admin_fname ?>" required>
            </div>
            <div class="mb-3">
              <label for="admin_mname" class="form-label">Middle Name:</label>
              <input type="text" id="admin_mname" name="admin_mname" class="form-control" placeholder="Santos" value="<?= $adminInfo->admin_mname ?>" required>
            </div>
            <div class="mb-3">
              <label for="admin_lname" class="form-label">Last Name:</label>
              <input type="text" id="admin_lname" name="admin_lname" class="form-control" placeholder="Dela Cruz" value="<?= $adminInfo->admin_lname ?>" required>
            </div>
            <div class="mb-3">
              <label for="admin_email" class="form-label">Email:</label>
              <input type="text" id="admin_email" name="admin_email" class="form-control" placeholder="juandc@gmail.com" value="<?= $adminInfo->admin_email ?>" required>
            </div>
            <input type="hidden" name="id" value="<?= $adminInfo->id ?>">
        </div>
        <div class="modal-footer">
          <div class="d-flex justify-content-end">
            <a href="<?= ROOT ?>/adminpage/users" type="button" class="btn btn-secondary">Close</a>
            <button type="submit" name="updateAdmin" class="btn btn-primary">Save Changes</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
<div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
  <div class="d-flex justify-content-start align-items-center border">
   
    <?php if ($admins != null) {
      foreach ($admins as $admin) { ?>
        <form action="" method="post">

          <input type="hidden" name="id" value="<?= $admin->id ?>">

          <button class="btn btn-<?= $_SESSION['theme'] ?> m-3 pt-4 rounded shadow" type="submit" name="editAdmin"><i class="fa fa-user h3"></i>
            <p><?= $admin->admin_fname . ' ' . $admin->admin_lname ?></p>
          </button>
        </form>
    <?php }
    } ?>
    <button class="btn btn-primary m-3 pt-3 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#addAdminModal">
      <div><i class="fa fa-plus h2"></i></div>
    </button>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAdminModalLabel">Add New Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="mb-3">
            <label for="code" class="form-label">ID:</label>
            <input type="text" id="code" name="code" class="form-control" placeholder="admin1" required>
          </div>
          <div class="mb-3">
            <label for="admin_fname" class="form-label">First Name:</label>
            <input type="text" id="admin_fname" name="admin_fname" class="form-control" placeholder="Juan" required>
          </div>
          <div class="mb-3">
            <label for="admin_mname" class="form-label">Middle Name:</label>
            <input type="text" id="admin_mname" name="admin_mname" class="form-control" placeholder="Santos" required>
          </div>
          <div class="mb-3">
            <label for="admin_lname" class="form-label">Last Name:</label>
            <input type="text" id="admin_lname" name="admin_lname" class="form-control" placeholder="Dela Cruz" required>
          </div>
          <div class="mb-3">
            <label for="admin_email" class="form-label">Email:</label>
            <input type="email" id="admin_email" name="admin_email" class="form-control" placeholder="juandc@gmail.com" required>
          </div>
          <div class="form-group mb-4">
      <label for="password"><strong>Password</strong> <i class="">(default)</i></label>
      <input type="text" class="form-control" name="admin_pass" disabled placeholder="admin123">
    </div>
    <input type="hidden" name="usertype" value="admin">
      </div>
      <div class="modal-footer">
        <div class="d-flex justify-content-end">
          <a href="" type="button" class="btn btn-secondary">Close</a>
          <button type="submit" name="addAdmin" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  

  <!-- JavaScript to show the modal -->
  <?php if (!empty($adminInfo)) : ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById("editAdminModal"));
        myModal.show();
      });
    </script>
  <?php endif; ?>


  <?php include 'partials/adminpage_footer.php'; ?>