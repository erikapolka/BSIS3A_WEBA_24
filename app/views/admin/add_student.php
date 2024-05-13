<?php include 'partials/adminpage_header.php'; ?>

<h3><a href="<?= ROOT ?>/adminpage/studentlist"><i class="fa fa-arrow-left text-secondary"></i></a> Add New Student</h3>


<div class="row mt-4 shadow p-3 rounded">
  <!-- Form for adding a new student -->
  <form action="" method="post">
<div class="row">
    <div class="form-group col-4">
      <label for="student_id"><strong>Student ID</strong></label>
      <input type="text" class="form-control mb-3" id="student_id" name="stud_code" placeholder="MA12345678" required autocomplete="off">
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
        <input type="text" value="<?= get_var('stud_fname') ?>" class="form-control" id="first_name" name="stud_fname" required autocomplete="off">
      </div>
      <div class="form-group col-lg-4 col-sm-12">
        <label for="middle_name"><strong>Middle Name</strong></label>
        <input type="text" value="<?= get_var('stud_mname') ?>" class="form-control" id="middle_name" name="stud_mname" autocomplete="off">
      </div>
      <div class="form-group col-lg-4 col-sm-12">
        <label for="last_name"><strong>Last Name</strong></label>
        <input type="text" value="<?= get_var('stud_lname') ?>" class="form-control" id="last_name" name="stud_lname" required autocomplete="off">
      </div>
    </div>



    <div class="row mb-3">


      <div class="form-group col-lg-4 col-sm-12">
        <label for="section"><strong>Course, Yr.&Sec</strong></label>
        <select id="dSelect" class="form-select" required name="stud_class" value="<?= get_var('stud_class') ?>">
          <option value="">Search</option>
          <?php foreach ($classOption as $option) { ?>
            <option value="<?= $option->id ?>" <?php if (get_var('stud_class') == $option->id) echo "selected"; ?>><?= $option->class_course . "-" . $option->class_level . $option->class_section ?></option>
          <?php } ?>
        </select>
      </div>


      <div class="form-group col-lg-8 col-sm-12">
        <label for="email"><strong>Email</strong></label>
        <input type="email" value="<?= get_var('stud_email') ?>" class="form-control" id="email" name="stud_email" placeholder="sample@email.com" required autocomplete="off">
      </div>
    </div>
    <div class="form-group mb-4">
      <label for="password"><strong>Password</strong> <i class="">(default)</i></label>
      <input type="text" class="form-control" name="stud_pass" disabled placeholder="@Student01">
    </div>
    <div class="d-flex justify-content-center"><button type="submit" class="btn btn-primary w-25 ">Save</button></div>
    
  </form>
</div>

<?php include 'partials/adminpage_footer.php'; ?>