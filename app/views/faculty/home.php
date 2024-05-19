<?php include "partials/facultypage_header.php"; ?>

<?php if ($acads_default->status == '1') { ?>
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh;">
        <div class="p-5 border rounded shadow">
            <div class="">
                <p class="h5"><strong>Faculty Evaluation</strong></p>
                <?= $_SESSION['schoolname'] ?><br>
                A.Y. <?= $acads_default->academic_year ?> <br> Semester <?= $acads_default->semester ?>
                <p></p>
            </div>

           
                <div><a href='<?= ROOT ?>/facultypage/result?id=<?=$_SESSION['TOKEN'] ?>' class="btn btn-<?= $theme ?> shadow mt-5">View Result <i class="fa fa-arrow-right mx-2"></i></a></div>
            
        </div>
    </div>


<?php } else { ?>
    <div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
        <div class="h4">
            <p>The Faculty Evaluation is currently</p>
            <p class="text-center"><strong>Not Available</strong></p>
        </div>
    </div>
<?php } ?>

<?php include "partials/facultypage_footer.php"; ?>