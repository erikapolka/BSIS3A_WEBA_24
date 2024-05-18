<?php include 'partials/adminpage_header.php'; ?>

<h3>Faculty List</h3>
<div class="form-group">
  <?php if (isset($_SESSION["info"])) : ?>
    <?php echo ($_SESSION["info"]) ?>
    <?php unset($_SESSION["info"]);
    ?>
  <?php endif; ?>
  <?php
// Initialize an associative array to store the subject counts for each faculty member
$facultySubjectCounts = [];

// Loop through each handling entry
  if ($handles != null) {
    foreach ($handles as $handle) {
      // Get the faculty ID from the handling entry
      $facultyId = $handle->faculty_id;

      // Check if the faculty ID already exists in the subject counts array
      if (!isset($facultySubjectCounts[$facultyId])) {
        // If not, initialize the count for this faculty member
        $facultySubjectCounts[$facultyId] = [];
      }

      // Add the subject ID to the array for this faculty member if it doesn't already exist
      if (!in_array($handle->subject_id, $facultySubjectCounts[$facultyId])) {
        $facultySubjectCounts[$facultyId][] = $handle->subject_id;
      }
    }
  }
// Now $facultySubjectCounts contains the count of subjects handled by each faculty member
?>
</div>
<div class="container mt-4 shadow p-3 rounded">
  <div class="row">
    <div class="col-6 col-sm-6">
      <!-- Search bar -->

      <form action="" method="post">
        <div class="row">
          <div class="col-8"><input type="text" value="<?= get_var('searchBox') ?>" class="form-control mb-2" name="searchBox" placeholder="Search"></div>
          <div class="col-1"><button type="submit" name="searchFaculty" class="btn btn-secondary"><i class="fa fa-search"></i></button></div>
        </div>
      </form>

    </div>
    <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
      <!-- Add button -->
      <a href="<?= ROOT ?>/adminpage/addfaculty" class="btn btn-primary mb-2">Add</a>
      <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 table-responsive">
      <!-- Bootstrap table -->
      <table class="table table-bordered table-hover table-striped table-sm">
        <thead class="table-dark">
          <tr class="text-center">
            <th>ID</th>
            <th>Name</th>
            <th>Handled Subject/s</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <!-- Table rows -->
          <?php if ($rows != null) { ?>
            <?php

            foreach ($rows as $item) { ?>
              <tr>
                <td class="py-2 px-2"><?= $item->code ?></td>
                <td class="px-5 py-2"><?= $item->faculty_lname . ", "  . $item->faculty_fname . " "  . $item->faculty_mname ?></td>
                <td class="px-5 py-2 text-center"><?= isset($facultySubjectCounts[$item->id]) ? count($facultySubjectCounts[$item->id]) : 0 ?></td>
                <td class="text-start py-2"><?= $item->faculty_email ?></td>
                <td class="d-flex justify-content-center py-2"><a href='<?= ROOT ?>/adminpage/editfaculty?id=<?= $item->token ?>' class="btn btn-success">
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




  <?php include 'partials/adminpage_footer.php'; ?>