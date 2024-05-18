<?php include 'partials/adminpage_header.php'; ?>

<h3>Student List</h3>
<div class="form-group">
  <?php if (isset($_SESSION["info"])) : ?>
    <?php echo ($_SESSION["info"]) ?>
    <?php unset($_SESSION["info"]);?>
  <?php endif; ?>
</div>


<div class="container mt-4 shadow p-3 rounded">
  <div class="row">
    <div class="col-6 col-sm-6">
      <!-- Search bar -->

      <form action="" method="post">
        <div class="row">
          <div class="col-8"><input type="text" value="<?= get_var('searchBox') ?>" class="form-control mb-2" name="searchBox" placeholder="Search"></div>
          <div class="col-1"><button type="submit" name="searchStudent" class="btn btn-secondary"><i class="fa fa-search"></i></button></div>
        </div>
      </form>

    </div>
    <div class="col-6 col-sm-6 text-right d-flex justify-content-end">
      <!-- Add button -->
      <a href="<?= ROOT ?>/adminpage/addstudent" class="btn btn-primary mb-2">Add</a>
      <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addStudentModal">Add</button> -->
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 table-responsive">
      <!-- Bootstrap table -->
      <table class="table table-bordered table-hover table-striped table-sm">
        <thead class="table-dark">
          <tr class="text-center">
            <th>Student ID</th>
            <th>Name</th>
            <th>Course, Year & Section</th>
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
                <td class="px-5 py-2"><?= $item->stud_lname . ", "  . $item->stud_fname . " "  . $item->stud_mname ?></td>
                <td class="text-center py-2"><?= isset($class[$item->stud_class]) ? $class[$item->stud_class] : 'N/A' ?></td>
                <td class="text-start py-2"><?= $item->stud_email ?></td>
                <td class="d-flex justify-content-center py-2"><a href='<?= ROOT ?>/adminpage/editstudent?id=<?= $item->token ?>' class="btn btn-success">
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