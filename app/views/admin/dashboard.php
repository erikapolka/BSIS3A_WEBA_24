<?php include 'partials/adminpage_header.php'; ?>

<h3>Dashboard</h3>
<div class="mt-4 shadow p-3 rounded">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body bg-secondary-subtle">
                <br>
                <div class="col-md-6">
                    <?php foreach ($rows as $item) { ?>
                        <p class="fs-5 m-0">Academic Year: <strong><?= $item->academic_year ?></strong><br>
                        <p class="fs-5"> Semester: <strong><?= $item->semester ?></strong></p>
                        <p class="fs-5">Evaluation Status: <?php
                                                            switch ($item->status) {
                                                                case '0':
                                                                    echo '<strong class="text-secondary">Pending</strong>';
                                                                    break;
                                                                case '1':
                                                                    echo '<strong class="text-success">Ongoing</strong>';
                                                                    break;
                                                                case '2':
                                                                    echo '<strong class="text-danger">Closed</strong>';
                                                                    break;
                                                                default:
                                                                    echo 'N/A';
                                                            }
                                                            ?></p>
                    <?php }; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card ">
                <div class="card-body">
                    <h5>
                        <div class="card-title">Total Faculties</div>
                    </h5>
                    <div class=" d-flex justify-content-between align-content-center pt-3">
                        <div class="card-text mx-4">
                            <h1><strong><?= $_SESSION['totalFaculty'] ?></strong></h1>
                        </div>
                        <i class="fa fa-chalkboard-user fs-1 text-black-50 mx-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card ">
                <div class="card-body">
                    <h5>
                        <div class="card-title">Total Students</div>
                    </h5>
                    <div class=" d-flex justify-content-between align-content-center pt-3">
                        <div class="card-text mx-4">
                            <h1><strong><?= $_SESSION['totalStudent'] ?></strong></h1>
                        </div>
                        <i class="fa fa-user-friends fs-1 text-black-50 mx-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card ">
                <div class="card-body">
                    <h5>
                        <div class="card-title">Total Classes</div>
                    </h5>
                    <div class=" d-flex justify-content-between align-content-center pt-3">
                        <div class="card-text mx-4">
                            <h1><strong><?= $_SESSION['totalSection'] ?></strong></h1>
                        </div>
                        <i class="fa fa-book fs-1 text-black-50 mx-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 mb-3">
            <div class="card ">
                <div class="card-body">
                    <h5>
                        <div class="card-title">Total Users</div>
                    </h5>
                    <div class=" d-flex justify-content-between align-content-center pt-3">
                        <div class="card-text mx-4">
                            <h1><strong><?= $_SESSION['totalAdmin'] ?></strong></h1>
                        </div>
                        <i class="fa fa-users fs-1 text-black-50 mx-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/adminpage_footer.php'; ?>