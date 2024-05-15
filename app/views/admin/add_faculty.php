<?php include 'partials/adminpage_header.php'; ?>

<h3><a href="<?= ROOT ?>/adminpage/facultylist"><i class="fa fa-arrow-left text-secondary"></i></a> Add New Faculty</h3>


<div class="row mt-4 shadow p-3 rounded">
  <!-- Form for adding a new faculty -->
  <form action="" method="post">
<div class="row">
    <div class="form-group col-4">
      <label for="faculty_id"><strong>ID</strong></label>
      <input type="text" class="form-control mb-3" id="faculty_id" name="faculty_code" placeholder="24-00000" required autocomplete="off">
    </div>
    <div class="form-group col-8">
      <?php if (isset($_SESSION["errorId"])) : ?>
        <?php echo ($_SESSION["errorId"]) ?>
        <?php unset($_SESSION["errorId"]); // Clear the error message from session 
        ?>
      <?php endif; ?>
    </div>
    </div>

    <div class="row d-flex justify-content-start mb-3">
      <div class="form-group col-lg-4 mb-2 col-sm-12">
        <label for="first_name"><strong>First Name</strong></label>
        <input type="text" value="<?= get_var('faculty_fname') ?>" class="form-control" id="first_name" name="faculty_fname" required autocomplete="off">
      </div>
      <div class="form-group col-lg-4 col-sm-12">
        <label for="middle_name"><strong>Middle Name</strong></label>
        <input type="text" value="<?= get_var('faculty_mname') ?>" class="form-control" id="middle_name" name="faculty_mname" autocomplete="off">
      </div>
      <div class="form-group col-lg-4 col-sm-12">
        <label for="last_name"><strong>Last Name</strong></label>
        <input type="text" value="<?= get_var('faculty_lname') ?>" class="form-control" id="last_name" name="faculty_lname" required autocomplete="off">
      </div>
    </div>



    <div class="row mb-3">


      <div class="form-group col-lg-8 col-sm-12">
        <label for="email"><strong>Email</strong></label>
        <input type="email" value="<?= get_var('faculty_email') ?>" class="form-control" id="email" name="faculty_email" placeholder="sample@email.com" required autocomplete="off">
      </div>
    </div>
    <div class="form-group mb-4">
      <label for="password"><strong>Password</strong> <i class="">(default)</i></label>
      <input type="text" class="form-control" name="faculty_pass" disabled placeholder="@Faculty01">
    </div>
    <input type="hidden" name="usertype" value="faculty">
    <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary w-25 ">Save</button></div>
    
  </form>
</div>

<?php include 'partials/adminpage_footer.php'; ?>