<?php include 'partials/adminpage_header.php'; ?>

<h3>Student List</h3>
<div class="container mt-5">
    <div class="row ">
        <div class="col-6 col-sm-6">
            <!-- Search bar -->
            <input type="text" class="form-control mb-2" placeholder="Search">
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
                <thead class="table-primary">
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
                    <?php

                    foreach ($rows as $item) { ?>
                        <tr>
                            <td class="py-2 px-2"><?= $item->stud_code ?></td>
                            <td class="px-5 py-2"><?= $item->stud_lname . ", "  . $item->stud_fname . " "  . $item->stud_mname ?></td>
                            <td class="text-center py-2"><?= isset($class[$item->stud_class]) ? $class[$item->stud_class] : 'N/A' ?></td>
                            <td class="text-start py-2"><?= $item->stud_email ?></td>
                            <td class="d-flex justify-content-center py-2"><button class="btn btn-success" data-toggle="modal" data-target="#viewStudentModal">
                                    <i class="fa fa-eye" ></i>
                    </button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center ">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>


<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1" role="dialog" aria-labelledby="viewStudent" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewStudent">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach($rows as $info){
          ?><p><?= $info->stud_code?></p>



      <?php } ?>
        This is a simple modal example.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- Add more buttons or actions here if needed -->
      </div>
    </div>
  </div>
</div>




<?php include 'partials/adminpage_footer.php'; ?>